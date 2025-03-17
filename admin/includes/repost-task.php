<?php

if(isset($_GET["repost-task"])){
    $task_id = filterValue($_GET["repost-task"]);

    try{
        $task->repostTask($task_id);
        $_SESSION["err"] = [
            "msg" => "Reposting successful!",
            "err" => false
        ];

    }catch(Exception $err){
        $_SESSION["err"] = [
            "msg" => $err->getMessage(),
            "err" => false
        ];
    }

    header("Location:". $_SERVER["HTTP_REFERER"]);
    exit();
}