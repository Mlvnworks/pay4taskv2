<?php

if(isset($_POST["request-transfer"])){
    $account = filterValue($_POST["account"]);
    $amount = $user->getUserData($_COOKIE["uid"])["earning"];
    $method = filterValue($_POST["request-transfer"]);

    

    try{
        $response = $user->requestTransfer($account, $_COOKIE["uid"], $method);
        if($response["error_msg"] == "200"){
            $_SESSION["err"] = [
                "msg" => "Successfully requested!",
                "err" => false
            ];
        }else{
            $_SESSION["err"] = [
                "msg" => "Something went wrong!",
                "err" => true
            ];
        }
        
    }catch(Exception $err){
        $_SESSION["err"] = [
            "msg" => "Something went wrong!",
            "err" => true
        ];
    }

    header("Location:". $_SERVER["HTTP_REFERER"]);
    exit();
    die();
}