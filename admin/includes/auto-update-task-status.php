<?php


try{
    $task->autoUpdateStatus();
}catch(Exception $err){
    $_SESSION["err"] = [
        "msg" => $err->getMessage(),
        "err" => true
    ];
}