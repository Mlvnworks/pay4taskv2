<?php


if(isset($_GET["search-task"])){
    $key = filterValue($_GET["search-task"]);

    try{
        echo json_encode(
            [
                "msg" => $task->search($key),
                "err" => false
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