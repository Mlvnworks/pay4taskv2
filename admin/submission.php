<?php


// Config
require("./includes/set-default-timezone.php");
require("../config.php");

// tools
require("../tools/getUserIp.php");
require("../tools/send-email/sendEmail.php");
require("../tools/formatTimeStamp.php");
require("../tools/filterValue.php");
require("../tools/emailEncrypt.php");
require("../tools/toCurrencySign.php");
require("../tools/uploadToDrive.php");
require("../tools/deleteOnGoogleDrive.php");

// Classes 
require("../classes/System.php");
require("../classes/Admin.php");
require("../classes/User.php");
require("../classes/Wallet.php");
require("../classes/Task.php");


// Initialization
$system = new System($CONNECTION);
$admin = new Admin($CONNECTION);
$user = new User($CONNECTION);
$wallet = new Wallet($CONNECTION);
$task = new Task($CONNECTION);



// // Validate action on admin access
// require("./includes/review-action.php");

// // Check the acces of the admin control
// require("./includes/check-access.php");


// UPDATE SETIINGS
require("./includes/update-settings.php");


// VALIDATE CHANGE ADMIN'S NAME
require("./includes/change-admin-name.php");

// VALIDATE CHANGE ADMIN'S NAME
require("./includes/change-admin-name.php");

// GET USERS LISTS
require("./includes/get-users-list.php");

// GET USERS LISTS
require("./includes/search-user.php");

// GET VALIDATE NEW TASK
require("./includes/new-task.php");

// GET TASKS LIST
require("./includes/get-tasks-list.php");

// SEARCH  TASK 
require("./includes/search-task.php");

// DELETE  TASK 
require("./includes/delete-task.php");

// SET TASK STATUS
require("./includes/set-task-status.php");

// SET TASK STATUS
require("./includes/edit-task-details.php");

// CHANGE TASK THUMBNAIL    
require("./includes/change-task-thumbnail.php");

// AUTO UPDATE TASK STATUS 
require("./includes/auto-update-task-status.php");


// AUTO UPDATE TASK STATUS 
require("./includes/search-proof.php");


// UPDATE PROOF STATUS
require("./includes/update-proof-submission-status.php");


// SEARCH TRANSFER REQUEST
require("./includes/search-transfer-request.php");

// UPDATE TRANSFER REQUEST
require("./includes/update-transfer-request.php");


// UPDATE UPGRADE REQUEST
require("./includes/update-upgrade-request.php");


// APPROVE ALL PROOF
require("./includes/approve-all-proof.php");

// CHECK REFERENCE NUMBER
require("./includes/check-reference-number.php");

// INSERT REFERENCE NUMBER
require("./includes/insert-new-reference.php");

// REPOST TASK
require("./includes/repost-task.php");




