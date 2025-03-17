<?php

// Config
require("./includes/set-default-timezone.php");
require("./config.php");

// tools
require("./tools/getUserIp.php");
require("./tools/send-email/sendEmail.php");
require("./tools/formatTimeStamp.php");
require("./tools/filterValue.php");
require("./tools/toCurrencySign.php");
require("./tools/uploadToDrive.php");
require("./tools/deleteOnGoogleDrive.php");


// Classes 
require("./classes/System.php");
require("./classes/Admin.php");
require("./classes/User.php");
require("./classes/Google.php");
require("./classes/Task.php");

// Initialization
$system = new System($CONNECTION);
$admin = new Admin($CONNECTION);
$user = new User($CONNECTION);
$task = new Task($CONNECTION);
$google  = new Google();



// LOGOUT USER  
require("./includes/logout-user.php");

// USER LOGIN  
require("./includes/user-login.php");


// REGISTER NEW USER  
require("./includes/user-registration.php");

// SEND USER'S SIGNUP OTP  
require("./includes/send-otp.php");


// REDIRECT UNLOGIN USER
require("./includes/redirect-unlogin-user.php");

// SUBMIT TASK COMPLETION
require("./includes/submit-task-completion-proof.php");

// REQUEST FOR EARNING TRANSFER
require("./includes/request-transfer.php");

// REQUEST ACTIVATION
require("./includes/request-activation.php");