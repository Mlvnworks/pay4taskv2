<?php


if(isset($_POST["edit-task-details"])){
    $task_id = filterValue($_POST["edit-task-details"]);
    $instruction = filterValue($_POST["instruction"]);
    $application = filterValue($_POST["app"]);
    $link = filterValue($_POST["link"]);
    $reward = filterValue($_POST["reward"]);
    $max_reward = trim($_POST["max-reward"]) !== "" ? filterValue($_POST["max-reward"]) : -1;
    $expiration = $_POST["expiration"] !== "" ? filterValue(strtotime( $_POST["expiration"])) : -1;



    try{
        $task->editTask($task_id, $instruction, $application, $link, $reward, $max_reward, $expiration);
        
        $_SESSION["err"] = [
            "msg" => "Task updated successfully!",
            "err" => false
        ];

    }catch(Exception $err) {
        $_SESSION["err"] = [
            "msg" => $err->getMessage(),
            "err" => true
        ];
    }

    header("Location:". $_SERVER["HTTP_REFERER"]);
    exit();
    die();
}