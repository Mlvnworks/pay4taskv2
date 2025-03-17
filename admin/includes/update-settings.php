<?php

// UPDATE SETTINGS 
if(isset($_GET["update-settings"])){
    $settings_id = filterValue($_GET["settings-id"], 'int');
    $value = filterValue($_GET["value"], 'int');

    try{
        $system->setSystemSettings($settings_id, $value);
        echo json_encode([
            "error_msg" => 200,
             "err" => false
        ]);

    }catch(Exception $err){
        echo json_encode([
            "error_msg" => $err,
            "err" => true
        ]); 
    }
    die();
}