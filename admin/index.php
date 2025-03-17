<?php
require '../vendor/autoload.php'; // Load Google API client
// Start session
session_start();

try{
    $content = isset($_GET["c"]) ?  $_GET["c"] : "dashboard";
    
    // Require Submissions 
    require("./submission.php");

    // Require Navigator
    require("./navigator/navigator.php");

    // Close the connection
    $CONNECTION->close();
}catch(Exception $err){
    print($err);
}

// Destroy Session
session_destroy();