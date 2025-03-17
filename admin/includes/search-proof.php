<?php

if(isset($_GET["search-proof"])){
    $key = filterValue($_GET["search-proof"]);
    $filter = filterValue($_GET["filter"]);

    try{
        echo json_encode([
            "msg" => $task->searchProof($key, $filter),
            "err" => true
        ]);
    }catch(Exception $err){
        echo json_encode([
            "msg" => $err->getMessage(),
            "err" => true
        ]);
    }

    die();
}