<?php


if(isset($_GET["set-task-status"])){
    $task_id = filterValue($_GET["set-task-status"]);

    try{    
        $task->setTaskStatus($task_id);

        $_SESSION["err"] = [
            "msg" => "Task Successfully Updated!",
            "err" => false
        ];

    }catch(Exception $err){
        $_SESSION["err"] = [
            "msg" => $err->getMessage(),
            "err" => true
        ];
    }


    header("Location:". $_SERVER["HTTP_REFERER"]);
    exit();
    die();
}