<?php

class Wallet{
    private $connection;

    function __construct($connection){
        $this->connection = $connection;
    }


    // GET WALLET DATA
    function getWallet($uid){
        return $this->connection->query("
            SELECT w.* FROM wallet w WHERE w.user_id = '$uid'; 
        ")->fetch_assoc();
    }
}