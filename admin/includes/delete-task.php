<?php

if(isset($_GET["delete-task"])){
    $task_id = filterValue($_GET["delete-task"]);
    $task_img_id = $task->getTaskData($task_id)["task_img"];

    
    try{
        $task->deleteTask($task_id, $task_img_id);

       $_SESSION["err"] = [
            "msg" => "Task deleted successfully!",
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
    die();
}