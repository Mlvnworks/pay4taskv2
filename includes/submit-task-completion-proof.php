<?php

if(isset($_POST["submit-task-completion-proof"])){
    $user_id = $_COOKIE["uid"];
    $task_id = filterValue($_POST["submit-task-completion-proof"]);
    $file = $_FILES["proof"];

    try{
        $response = $task->submittedProof($user_id, $file, $task_id);

        if($response["error_msg"] == "200"){
            $_SESSION["err"] = [
                "msg" => "Succesfully submitted, please wait for verification. Thank you!",
                "err" => false
            ];
        }else if($response["error_msg"] == "196"){
            $_SESSION["err"] = [
                "msg" => "Insufficient Energy!",
                "err" => true
            ];
        }else{
            $_SESSION["err"] = [
                "msg" => "Something went wrong!",
                "err" => true
            ];
        }

    }catch(Exception $err){
        $_SESSION["err"] = [
            "msg" => $err->getMessage(),
            "err" => true
        ];
    }

    
    header("Location:". $_SERVER["HTTP_REFERER"]);
    die();
}