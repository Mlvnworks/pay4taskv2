<?php

if(isset($_GET["check-reference-number"])){
    echo json_encode(["data" => $system->checkReference(filterValue($_GET["check-reference-number"]))]);
    die();
}