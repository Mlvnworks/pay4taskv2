<?php


//LOCAL
// $db_username = "root";
// $db_host = "127.0.0.1";
// $db_port  = 3306;
// $db_name = "pay4Task";
// $db_password = "";

// DEPLOYED
$db_username = "root";
$db_host = "mainline.proxy.rlwy.net";
$db_port  = 52019;
$db_name = "railway";
$db_password = "nhePVoccMrxjrGKZKTxiduUYbINmIcju";



$CONNECTION = new mysqli($db_host, $db_username, $db_password, $db_name, $db_port);
