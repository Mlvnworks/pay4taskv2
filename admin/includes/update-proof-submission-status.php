<?php

if(isset($_GET["update-proof"])){
    $proof_id = filterValue($_GET["update-proof"]);
    $status = filterValue($_GET["status"]);

    try{
        $response = $task->updateProofStatus($proof_id, $status);
     
        if($response["error_msg"] == "200"){
            $_SESSION["err"] = [
                "err" => false,
                "msg" => "Successfully updated!"
            ];
        }else{
            $_SESSION["err"] = [
                "err" => true,
                "msg" => "Something went wrong! error code: ". $response["error_msg"] 
            ];
        }

    }catch(Exception $err){
        $_SESSION["err"] = [
                "err" => true,
                "msg" => $err->getMessage()
        ];
    }

    header("Location:". $_SERVER["HTTP_REFERER"]);
    exit();
    die();
}