<?php

if(isset($_GET["update-transfer-request"])){
    $request_id = filterValue($_GET["update-transfer-request"]);
    $status = filterValue($_GET["status"]);

    try{
        $response = $system->updateTransferRequest($request_id, $status);

        if($response["error_msg"] == "200"){
            $_SESSION["err"] =[
                "err" => false,
                "msg" => "Successfully updated!"
            ];
        }else {
            $_SESSION["err"] =[
                "err" => true,
                "msg" => "Something went wrong!"
            ];
        }
    }catch(Exception $err){
        $_SESSION["err"] =[
            "err" => true,
            "msg" => $err->getMessage()
        ];
    }
    header("Location:". $_SERVER["HTTP_REFERER"]);
    exit();
    die();
}