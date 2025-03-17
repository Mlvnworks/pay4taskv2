<?php


if(isset($_GET["insert-new-reference"])){
    $new_reference = filterValue($_GET["insert-new-reference"]);
    $request_id = filterValue($_GET["id"]);

    try{
        $system->insertReference($new_reference, $request_id);
        echo json_encode([
            "err" => false
        ]);
    }catch(Exception $err){
        echo json_encode([
            "err" => true
        ]);
    }
    die();
}