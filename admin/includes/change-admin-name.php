<?php

if(isset($_GET["change-admin-name"])){
    $admin_id = filterValue($_GET["admin-id"], 'int');
    $admin_name = filterValue($_GET["name"]);

    try{
        $admin->setName($admin_id, $admin_name);
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