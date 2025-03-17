<?php

if(isset($_GET["get-users-list"])){
    $offset = filterValue($_GET["offset"]);
    $limit  = filterValue($_GET["limit"]);

    try{
        echo json_encode([
            "data" => $user->getList($offset, $limit),
            "err" => false
        ]);

    }catch(Exception $err){
        echo json_encode([
            "data" => $err,
            "err" => true
        ]);
    }

    die();
}