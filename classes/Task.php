<?php

use Google\Service\CloudSearch\Resource\Query;

class Task{
    private $connection;

    function __construct($connection){
        $this->connection = $connection;
    }


    // CREATE NEW TASK
    function newTask($instruction,  $expiration, $app, $link, $img, $reward,  $max_reward){
        $new_task_id = rand(111111111, 999999999);
        $create_datetime = time();

        $this->connection->query("
            INSERT INTO task(task_id, task_instruction, created_datetime, expiration, task_app, task_link, task_img, task_reward, max_reward, overall_spent, status)
            VALUES('$new_task_id', '$instruction','$create_datetime','$expiration', '$app', '$link', '$img', '$reward','$max_reward', 0, 1);
        ");

        return $this->connection->affected_rows > 0;
    }


    // FETCH TASKS FROM DATABASE
    function getList($offset, $limit){
        $tasks_list = [];

        $fetch = $this->connection->query("
            SELECT * 
            FROM task t
            ORDER BY t.created_datetime DESC
            LIMIT $limit OFFSET $offset
        ");

        while($row = $fetch->fetch_assoc()){
            $tasks_list = [...$tasks_list, $row];
        }

        return $tasks_list;
    }   

    // SEARCH TASK
    function search($key){
        $task_list = [];

        $search = $this->connection->query("
            SELECT * 
            FROM task t
            WHERE CONCAT(t.task_app, t.task_instruction, t.task_id) LIKE  '%$key%'
            ORDER BY t.created_datetime DESC;
        ");

        while($row = $search->fetch_assoc()){
            $task_list = [...$task_list, $row];
        }

        return $task_list;
    }


    // GET TASK DATA
    function getTaskData($task_id){
        return $this->connection->query("
            SELECT * 
            FROM task t
            WHERE t.task_id = $task_id; 
        ")->fetch_assoc();
    }


    // DELETE TASK
    function deleteTask($task_id, $file_id){
        if(deleteFileFromDrive($file_id)){
            $this->connection->query("
                DELETE FROM task WHERE task_id = $task_id;
            ");
        }else{
            throw new Exception("Failed to delete file on google drive");
        }

    }


    // SET TASK STATUS
    function setTaskStatus($task_id){
        $current_task_status = $this->getTaskData($task_id)["status"];
        $to_status = $current_task_status == "-1" ? 1 : -1;

        $this->connection->query("
            UPDATE task 
            SET status = $to_status 
            WHERE task.task_id = $task_id 
        ");
    }

    // EDIT TASK 
    function editTask($task_id, $instruction, $application, $link, $reward, $max_reward, $expiration){
        $this->connection->query("
            UPDATE task t
            SET t.task_instruction = '$instruction',
                t.task_app = '$application',
                t.task_link = '$link',
                t.task_reward = '$reward',
                t.max_reward = '$max_reward',
                t.expiration = '$expiration'
            WHERE t.task_id = '$task_id'
        ");
    }

    // CHANGE TASK THUMBNAIL
    function changeThumbnail($task_id, $new_thumbnail){
        // GET THE CURRENT FILE ID
        $file_id = $this->getTaskData($task_id)["task_img"];


        if(deleteFileFromDrive($file_id)){
            $new_file_id = uploadToGoogleDrive($new_thumbnail);

            if($new_file_id){
                $this->connection->query("
                    UPDATE task 
                    SET task_img = '$new_file_id'
                    WHERE task_id = $task_id;
                ");
            }else{ 
                throw new Exception("Failed to upload new thumbnail");
            }
        }else{
            throw new Exception("Failed to delete file on google drive");
        }

    }


    // GET TASK COUNT/SIZE
    function getSize(){
        return $this->connection->query("
            SELECT 1 FROM task
        ")->num_rows;
    }


    // GET ACTIVE TASKS
    function getActiveTask($uid){
        $task_list = [];
        $current_time = time();

        $fetch_active_task = $this->connection->query("
            SELECT *
            FROM task t
            WHERE t.status != -1 AND
                  (t.expiration = -1 OR (t.expiration != -1 AND t.expiration > $current_time)) AND
                  (t.max_reward = -1 OR (t.max_reward != -1 AND t.overall_spent <= t.max_reward)) AND 
                  (SELECT COUNT(*) FROM task_submission ts WHERE ts.task_id = t.task_id AND ts.user_id = $uid AND (ts.status = 1 OR ts.status = 0)) = 0 
            ORDER BY t.created_datetime DESC;
        ");

        while($row = $fetch_active_task->fetch_assoc()){
            $task_list = [...$task_list, $row];
        }

        return $task_list;
    }


    function submittedProof($uid, $proof_file, $task_id){
        $uploaded_file_id = uploadToGoogleDrive($proof_file);
 
        if(!$uploaded_file_id) return throw new Exception("Failed to upload image on google drive");

        $submit = $this->connection->query("
            CALL submit_task_completion($uid, '$uploaded_file_id',". time() .", $task_id);        
        ");
        
        $response = $submit->fetch_assoc();
        if($response["error_msg"] != "200"){
            // DELETE UPLOADED FILE FROM DRIVE
            deleteFileFromDrive($uploaded_file_id);
        }
        
        $submit->free();
        $this->connection->next_result();

        return $response;
    }


    // GET SUBMITTED PROOF LIST
    function getSubmittedProof($status){
        $submitted_proof_list = [];

        $fetch_proof = $this->connection->query("
            SELECT ts.*,
                    u.name,
                    u.email,
                    t.task_id,
                    t.task_instruction,
                    t.task_img,
                    t.task_reward
            FROM task_submission ts 
            JOIN users u ON ts.user_id = u.user_id
            LEFT JOIN task t ON ts.task_id = t.task_id
            WHERE ts.status = '$status'
            ORDER BY ts.date_submitted ASC
            LIMIT 100
            OFFSET 0;
        ");

        while($proof = $fetch_proof->fetch_assoc()){
            $submitted_proof_list = [...$submitted_proof_list, $proof];
        }

        return $submitted_proof_list;
    }    


    // UPDATE TASK STATUS
    function autoUpdateStatus(){
        $current_time = time();

        $this->connection->query("
            UPDATE task t
            SET t.status = -1
            WHERE t.status != -1 AND
                  (t.expiration != -1 AND t.expiration <= $current_time) OR
                  (t.max_reward != -1 AND t.overall_spent >= t.max_reward)        
        ");
    } 

    // SEARCH PROOF
    function searchProof($key, $status){
        $proof_list = [];

        $search_proof = $this->connection->query("
            SELECT ts.*,
                    u.name,
                    u.email,
                    t.*
            FROM task_submission ts 
            JOIN users u ON ts.user_id = u.user_id
            JOIN task t ON ts.task_id = t.task_id
            WHERE ts.status = '$status' AND
                  CONCAT(u.name, u.email, t.task_id) LIKE '%$key%'
        ");

        while($proof = $search_proof->fetch_assoc()){
            $proof_list = [...$proof_list, $proof];
        }

        return $proof_list;
    }


    // UPDATE PROOF STATUS
    function updateProofStatus($proof_id, $status){
        $time = time();

       $submit = $this->connection->query("
            CALL update_proof_status('$proof_id', '$status', '$time');
        ");

        $data = $submit->fetch_assoc();
        $submit->free();
        $this->connection->next_result();
        return $data;
    }

    // GET PENDING PROOF IDS 
    function approveAllProof(){
        $ids = [];

        $get_pending_proof_ids = $this->connection->query("
            SELECT ts.submission_id FROM task_submission ts WHERE ts.status = 0;         
        ");

        while($row= $get_pending_proof_ids->fetch_assoc()){
            $ids = [...$ids, $row["submission_id"]];
        }

        array_map(function($id){
            $this->updateProofStatus($id, '1');
        }, $ids);   
    }

    function repostTask($task_id){
        $now = time();

        $this->connection->query("
            UPDATE task t SET created_datetime = '$now' WHERE t.task_id = '$task_id'             
        ");
    }
}



