<?php

class Admin{

    private $connection;

    function __construct($connection){
        $this->connection = $connection;
    }

    // GET THE REVIEW DATA
    function review($review_id){
        $get_review_data = $this->connection->query("
            SELECT ar.*,
                    a.device
            FROM admin_review ar 
            JOIN admin a ON a.admin_id = ar.admin_id
            WHERE  ar.request_id = '$review_id'
        ");
        if($get_review_data){
            $review_data = $get_review_data->fetch_assoc();

            return $review_data;
        }else{
            return new Exception("Failed to fetch review data.");
        }
    }

    // MODIFY ADMIN STATUS 
    function reviewAction($admin_id, $action){
        if($action == 1 || $action == -1 || $action == -2){
            return $this->connection->query("
                CALL admin_review_action('$admin_id', '$action');
            ") ->fetch_assoc();
        }else {
            return new Exception("Invalid action it should only be 1 or -1");
        }
    }

    //  GET ADMINS LISTS
    function get_list(){
        $get_admins = $this->connection->query("
            SELECT * FROM admin ORDER BY date_added DESC;
        ");

        $admin_list = [];

        while($admin = $get_admins->fetch_assoc()){
            $admin_list = [...$admin_list, $admin];
        }

        return $admin_list;
    }

    // UPDATE ADMIN NAME
    function setName($admin_id, $name){
        $this->connection->query("UPDATE admin SET name = '$name' WHERE admin_id = '$admin_id';");
    }

    //GET ADMIN COUNT/SIZE
    function size(){
        return $this->connection->query("SELECT * FROM admin")->num_rows;
    }
    
}