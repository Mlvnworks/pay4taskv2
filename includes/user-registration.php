<?php

if(isset($_POST["user-registration"])){
    $verification_id = filterValue($_POST["user-registration"], 'int');
    try{
        $response = $user->newUser($verification_id);

        if($response["error_msg"] == "200"){
            setcookie("uid", $response["user_id"], time() + (7 * 24 * 60 * 60), "/");
            header("Location:./");
            exit();
        }else if($response["error_msg"] == "199 - Email already exists"){
            $_SESSION["err"] = [
                "err" => true,
                "msg" => "Email Already Exists!"
            ];
            header("Location:./?create-account");
            exit();
        }else{
            $_SESSION["err"] = [
                "err" => true,
                "msg" => "Something went wrong!"
            ];
        }
    
    }catch(Exception $err){
        $_SESSION["err"] = [
            "err" => true,
            "msg" => "Something went wrong!"
        ];
    }

    header("Location:". $_SERVER["HTTP_REFERER"]);
    die();
}