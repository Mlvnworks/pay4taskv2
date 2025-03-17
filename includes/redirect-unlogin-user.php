<?php

if(!$user->checkLogin()){
    if(isset($_GET["c"])){
        if($_GET["c"] !== "dashboard" && $_GET["c"] !== 'user-login-google-callback' && $_GET["c"] !== 'user-registration-google-callback'){
            header('Location:./');
            exit();
        }
    }
}