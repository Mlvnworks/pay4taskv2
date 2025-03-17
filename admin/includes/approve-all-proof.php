<?php

if(isset($_GET["approve-all-proof"])){
        try{

            $task->approveAllProof();
            $_SESSION["err"] =[
                "err" => false,
                "msg" => "Successfully approve all"
            ];
        }catch(Exception $err){
            $_SESSION["err"] =[
                "err" => true,
                "msg" => $err->getMessage()
            ];
        }

    header("Location:". $_SERVER["HTTP_REFERER"]);
    die();
}