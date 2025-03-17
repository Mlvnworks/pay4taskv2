<?php

if(isset($_GET["search-user"])){
    try{   
        $key = filterValue($_GET["search-user"]);

        $search_result = $user->search($key);
        
        echo json_encode([
            "data" => $search_result,
            "err" => false
        ]);
    }catch(Exception $err){
        echo json_encode([
            "data" => $err->getMessage(),
            "err" => true
        ]);
    }
    die();
}