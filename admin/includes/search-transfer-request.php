<?php


if(isset($_GET["search-transfer-request"])){
    $status = filterValue($_GET["status"]);
    $key = filterValue($_GET["search-transfer-request"]);

    try{
        echo json_encode([
            "msg" => $system->searchTransferRequest($status, $key),
            "err" => false
        ]);
    }catch(Exception $err){
        echo json_encode([
            "msg" => $err->getMessage(),
            "err" => true
        ]);
    }

    die();
}