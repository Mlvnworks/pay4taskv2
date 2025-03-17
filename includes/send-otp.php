<?php 

if(isset($_GET["send-otp"])){
    $email = filterValue($_GET["email"]);
    $password = filterValue($_GET["password"]);
    $referral_used = isset($_COOKIE["ref-used"]) ? filterValue($_COOKIE["ref-used"]) : -1;

    try{
        echo json_encode($user->sendOtp($email, $password, "", $referral_used));
    }catch(Exception $err){
       echo json_encode($err->getMessage());
    }

    die();
}