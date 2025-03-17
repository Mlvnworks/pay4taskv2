<?php

if(isset($_GET["admin-action"])){
    $admin_id = filterValue($_GET["admin_id"], 'int');
    $action =  filterValue($_GET["action"], 'int');
    
    try{
        $validate_action = $admin->reviewAction($admin_id, $action);

        echo json_encode($validate_action);

    }catch(Exception $err){
        echo json_encode($err);
    }
    die();
}