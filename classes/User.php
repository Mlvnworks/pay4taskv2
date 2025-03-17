<?php

class User{
    private $connection;

    function __construct($connection){
        $this->connection = $connection;
    }


    // PROCESS USER REGISTRATION
    function newUser($verification_id){
        $result = $this->connection->query("
            CALL new_user($verification_id);
        ");
        
        $data = $result->fetch_assoc();
        $result->free();
        $this->connection->next_result();
        return $data;
    }
       

    function addNewPendingAccount($email, $password, $name, $referral_used){
        $result = $this->connection->query("
             CALL new_pending_account('$email', '$password', '$name', '$referral_used', '". time() ."', '". (time() + 10 * 60) ."');
        ");
        
        $data = $result->fetch_assoc();
        $result->free();
        $this->connection->next_result();
        return $data;
    }

    // SEND OTP 
    function sendOtp($email, $password, $name, $referral_used){
        $add_record_response = $this->addNewPendingAccount($email, $password, $name, $referral_used);

        if($add_record_response["error_msg"] == "200"){
            if(sendEmail($email, '', 'Pay4Task OTP NO-REPLY', "You Pay4Task One Time password is ". $add_record_response["otp_code"])){
                return $add_record_response;
            }else{
                return new Exception("Failed to send email!");
            }
            
        }else{  
            return new Exception("Failed to add new pending account!");
        }
    }

    // GET USER LIST
    function getList($offset, $limit){
        $user_list = [];


        $get_List = $this->connection->query("
            SELECT 
                u.user_id,
                u.name,
                u.email,
                u.referral_code,
                u.status,
                u.registration_date,
                w.*
            FROM 
                users u
            JOIN wallet w ON w.user_id = u.user_id
            ORDER BY u.registration_date DESC
             LIMIT $limit
            OFFSET $offset;
        ");

        while($row = $get_List->fetch_assoc()){
            $user_list = [...$user_list, $row];
        }

        return $user_list;
    }


    // GET USER DATA
    function getUserData($uid){

        return $this->connection->query("
            SELECT 
                u.user_id,
                u.name,
                u.email,
                u.referral_code,
                u.status,
                u.registration_date,
                u.referral_used,
                u.last_claim,
                u.status,
                w.*
            FROM 
                users u
            JOIN wallet w ON w.user_id = u.user_id
            WHERE u.user_id = '$uid';
        ")->fetch_assoc();
    }

    // GET TOTAL NUMBER/SIZE OF USERS
    function getSize(){
        return $this->connection->query("SELECT 1 FROM users")->num_rows;
    }

    // GET THE USERNAME OF THE INVITER
    function whoReferred($referrer_code){
        if($referrer_code == -1) return "No referrer";

        $req =  $this->connection->query("SELECT u.name, u.email FROM users u WHERE u.referral_code = $referrer_code;")->fetch_assoc();

        $name = $req["name"];
        $email = $req["email"];

        if($email === "" && $name === "") return "invalid referral code";

        return $name === "" ? emailEncrypt($email) : $name; 
    }


    // SEARCH USER BY id,name and email 
    function search($key){
        $users_list = [];

        $get_List = $this->connection->query("
            SELECT 
                u.user_id,
                u.name,
                u.email,
                u.referral_code,
                u.status,
                u.registration_date,
                w.*
            FROM 
                users u
            JOIN wallet w ON w.user_id = u.user_id
            WHERE LOWER(CONCAT(u.user_id, u.name, u.email)) LIKE  '%$key%'
            ORDER BY u.registration_date DESC
        ");

        while($row = $get_List->fetch_assoc()){
            $users_list = [...$users_list, $row];
        }

        return $users_list;
    }


    // CHECK LOGIN
    function checkLogin(){
        if(isset($_COOKIE["uid"])){
            $user_data = $this->getUserData($_COOKIE["uid"]);

            return $user_data !== null;
        }else{
            return false;
        }
    }


    // LOGIN USER
    function login($email, $password){
        $check_credential = $this->connection-> query("
            SELECT u.user_id 
            FROM users u
            WHERE u.email = '$email' AND u.password = '$password'
        ");

        if($check_credential ->num_rows > 0){
            return $check_credential->fetch_assoc()["user_id"];
        }

        return false;
    }


    // LOGOUT USER 
    function logout(){
        setcookie('uid', '', time() -100, '/');
    }


    // GET REFERRED ACCOUNT COUNT
    function getReferredCount($uid){
        return $this->connection->query("
            SELECT 1 
            FROM users u
            WHERE u.referral_used = (SELECT uu.referral_code from users uu WHERE user_id = $uid); 
        ")->num_rows;
    }


    // GET HISTORY
    function getHistory($uid){
        $history_list =[];

        $get_history =  $this->connection->query("
            SELECT * 
            FROM history h 
            WHERE h.user_id = $uid
            ORDER BY h.datetime DESC 
        ");


        while($row = $get_history->fetch_assoc()){
            $history_list = [...$history_list, $row];
        }

        return $history_list;
    }

    

    // check id can claim
    function canClaim($uid){
        $day_of_year = date('z') + 1;
        $last_claim = $this->getUserData($uid)["last_claim"];

        return $day_of_year != $last_claim;
    }


    // CLAIM DAILY ENERGY   
    function claimEnergy($uid){
        if(!$this->canClaim($uid)) return throw new Exception("Can't claim energy this time!");

        $response = $this->connection->query("
            CALL claim_energy($uid, ".  date('z') + 1 .", ". time() .");
        ");

        $res = $response->fetch_assoc();
        $response->free();
        $this->connection->next_result();
       

        if($res["error_msg"] != "200"){
            return throw new Exception("Something went wrong!");
        }else{
            return true;
        }
    }



    // GET SUBMITTED PROOF
    function getActivities($uid){
        $submitted_proof_list = [];

        $fetch_proof = $this->connection->query("
            SELECT ts.*,
                    u.name,
                    u.email,
                    t.task_instruction,
                    t.task_img,
                    t.task_reward
            FROM task_submission ts 
            JOIN users u ON ts.user_id = u.user_id
            LEFT JOIN task t ON ts.task_id = t.task_id
            WHERE ts.user_id = $uid
            ORDER BY ts.date_submitted DESC
        ");

        while($proof = $fetch_proof->fetch_assoc()){
            $submitted_proof_list = [...$submitted_proof_list, $proof];
        }

        return $submitted_proof_list;
    }


    // REQUEST TRANSFER
    function requestTransfer($account, $uid, $method){
       return $this->connection->query("
            CALL request_transfer('$account', '$uid','$method', '". time() ."' );
        ")->fetch_assoc();
    }


    // GET TRANSFER REQUEST
    function getTransferRequest($uid){
        $request_list = [];

        $fetch = $this->connection->query("
            SELECT * FROM transfer_request WHERE user_id = $uid ORDER BY request_date DESC;
        ");

        while($request = $fetch->fetch_assoc()){
            $request_list = [...$request_list, $request];
        }

        return $request_list;
    } 

    // SUBMIT ACTIVATION REQUEST
    function submitActivationRequest($receipt_file_id, $uid){
        return $this->connection->query("
            CALL request_activation('$uid', '$receipt_file_id', '". time() ."');
        ")->fetch_assoc();
    }

    function checkActivationRequest($uid){
        return $this->connection->query("
                SELECT ar.status FROM activation_requests ar WHERE ar.user_id = $uid AND ar.status != -1;
        ")->fetch_assoc();
    }
    
     function getInviteList($uid){
        $referral_code = $this->getUserData($uid)["referral_code"];
    
        $invited_list =[];
        $get_invited_list = $this->connection->query("
            SELECT name, email, registration_date, status FROM users WHERE referral_used = '$referral_code' ORDER BY registration_date DESC;     
        ");

        while($row = $get_invited_list->fetch_assoc()){
            $invited_list = [...$invited_list, $row];
        }

        return $invited_list;

    }
}