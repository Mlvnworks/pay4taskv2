<?php

if(isset($_POST["new-task"])){
    $task_instruction = filterValue($_POST["task-instruction"]);
    $task_app = filterValue($_POST["task-app"]);
    $task_link = filterValue($_POST["task-link"]);
    $task_reward = filterValue($_POST["task-reward"]);
    $task_max_spent =  $_POST["task-max-spent"] !== "" ? filterValue($_POST["task-max-spent"])  : -1;
    $task_date_end = $_POST["task-date-end"] !== "" ? strtotime(filterValue(value: $_POST["task-date-end"])) : -1;
    $task_thumbnail = $_FILES["task-thumbnail"];
    $task_thumbnail_uploaded_id = uploadToGoogleDrive($_FILES["task-thumbnail"]);


    // IF THE THUMBNAIL SUCCESSFULLY UPLOAD
    if($task_thumbnail_uploaded_id) {
        try{
            if($task->newTask($task_instruction, $task_date_end, $task_app, $task_link, $task_thumbnail_uploaded_id, $task_reward, $task_max_spent)){

                $_SESSION["err"] = [
                    "msg" => "New Task successully added!",
                    "err" => false
                ];
            }else{
                $_SESSION["err"] = [
                    "msg" => "Something went wrong!",
                    "err" => true
                ];
            }
        }catch(Exception $err){
            echo $err -> getMessage();
        }
    }else{
        $_SESSION["err"] = [
            "msg" => "Failed to upload thumbnail!",
            "err" => true
        ];
    }


    header("Location:". $_SERVER["HTTP_REFERER"]);
    exit();
    die();
}