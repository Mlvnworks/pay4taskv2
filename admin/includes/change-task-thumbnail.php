<?php

if(isset($_POST["change-thumbnail"])){
    $task_id = filterValue($_POST["change-thumbnail"]);
    $new_thumbnail = $_FILES["thumbnail"];

    
    try{    
        $task->changeThumbnail($task_id, $new_thumbnail);

        $_SESSION["err"] = [
            "msg" => "Thumbnail successfully updated!",
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
