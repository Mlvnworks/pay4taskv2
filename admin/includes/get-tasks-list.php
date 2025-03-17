<?php

if(isset($_GET["get-tasks-list"])){
    $offset = filterValue($_GET["offset"]);
    $limit = filterValue($_GET["limit"]);
    try{
        
        echo json_encode(
            [
                "msg" => $task->getList($offset, $limit),
                "err" => true
            ]
            );
    }catch(Exception $err){
        echo json_encode(
            [
                "msg" => $err->getMessage(),
                "err" => true
            ]
            );
    }
    die();
}