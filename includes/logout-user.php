<?php

if(isset($_GET["logout"])){
    $user->logout();
    header("Location:./");
    exit();
    die();
}