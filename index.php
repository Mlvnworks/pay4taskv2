<?php
require 'vendor/autoload.php'; // Include Google API Client
// Start session
session_start();

try{
    $content = isset($_GET["c"]) ?  $_GET["c"] : "dashboard";

    // Require Submissions 
    require("./submission.php");

    // Require Navigator
    require("./navigator/navigator.php");

}catch(Exception $err){
    print($err);
}

// Destroy Session
session_destroy();