<?php

if(isset($_GET["update-upgrade-request"])){
    $request_id = filterValue($_GET["update-upgrade-request"]);
    $status = filterValue($_GET["action"]);

    try{
        $response = $system->updateUpgradeRequest($request_id, $status);

        if($response["error_msg"] == "200"){
            $_SESSION["err"] = [
                "err" => false,
                "msg" => "Request successfully updated!"
            ];
        }else{
            $_SESSION["err"] = [
                "err" => true,
                "msg" => "Something went wrong! error: ". $response["error_msg"]
            ];
        }
    }catch(Exception $err){
        $_SESSION["err"] = [
            "err" => true,
            "msg" => "Something went wrong! error: ". $err->getMessage()
        ];
    }
    header("Location:". $_SERVER["HTTP_REFERER"]);
    die();
}