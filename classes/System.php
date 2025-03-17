<?php 

class System{
    private $connection;

    function __construct($connection){
        $this->connection = $connection;
    }


    // CHECK ADMIN ACCESS
    function checkAccess($device){
        
        $check_access_q = $this->connection->query("
            call check_admin_access('$device', ". time() .");
        ");

        $check_access = $check_access_q->fetch_assoc();
        $check_access_q->close();
        $this->connection->next_result();
       

        if($check_access["error_msg"] !== "200"){
             if($check_access["error_msg"] === "404"){
                
                // Send review email
                sendEmail('agustinmlvn1230@gmail.com', 'Admin Approve', 'Admin new access', "There is an new user trying to access the admin page, click the link below to review. Link will be expire within 20 minutes. Thank you    http://localhost/pay4Task/admin/?c=new-admin-access&id=". $check_access["review_id"]);
            }
            header("Location:../");
            exit();
        }
    }  

    
    // UPDATE SYSTEM SETTINGS
    function setSystemSettings($settings_id, $value){
        $this->connection->query("
            UPDATE system_control
            SET value = '$value'
            WHERE id = '$settings_id';
        ");
    }

    // GET SYSYTEM SETTINGS VALUE
    function getSystemSettings($settings_id){
        return $this->connection->query("SELECT * FROM system_control WHERE id = '$settings_id';")->fetch_assoc();
    }

    // GET TRANSFER REQUEST 
    function getTransferRequests($status){
        $request_list = [];

        $fetch_request_list = $this->connection->query("
            SELECT tr.*,
                    u.name,
                    u.email,
                    u.status AS user_status
            FROM transfer_request tr
            JOIN users u ON tr.user_id = u.user_id
            WHERE tr.status = $status
            ORDER BY tr.request_date 
        ");

        while($row = $fetch_request_list->fetch_assoc()){
            $request_list = [...$request_list, $row];
        }

        return $request_list;
    }

    // SEARCH TRANSFE4 REQUEST
    function searchTransferRequest($status, $key){
        $request_list = [];

        $fetch_request_list = $this->connection->query("
            SELECT tr.*,
                    u.name,
                    u.email,
                    u.user_id
            FROM transfer_request tr
            JOIN users u ON tr.user_id = u.user_id
            WHERE tr.status = $status AND CONCAT(u.name, u.email, u.user_id) LIKE '%$key%'
            ORDER BY tr.request_date;
        ");

        while($row = $fetch_request_list->fetch_assoc()){
            $request_list = [...$request_list, $row];
        }

        return $request_list;
    }

    // UPDATE TRANSFER REQUEST
    function updateTransferRequest($request_id, $status){
        return $this->connection->query("
            CALL update_transfer_request('$request_id', '$status', '". time() ."');
        ")->fetch_assoc();
    }

    // GET UPGRADE REQUESTS
    function getUpgradeRequests($status){
        $upgrade_requests = [];

        $get_requests = $this->connection->query("
            SELECT ar.*,
                    u.name,
                    u.email
            FROM activation_requests ar
            JOIN users u ON ar.user_id = u.user_id
            WHERE ar.status = '$status' 
            ORDER BY ar.datetime
        ");

        while($row = $get_requests->fetch_assoc()){
            $upgrade_requests = [...$upgrade_requests, $row];
        }

        return $upgrade_requests;
    }

    // UPDDATE UPGRADE REQUEST STATUS 
    function updateUpgradeRequest($request_id, $status){
        return $this->connection->query("
            CALL update_upgrade_request('$request_id', '$status', '". time() ."');
        ")->fetch_assoc();
    }
    
     // CHECK REFERENCE NUMBER 
    function checkReference($reference_number){
        return $this->connection->query("SELECT * FROM referrence_number rn WHERE rn.reference_number = '$reference_number'")->fetch_assoc();
    }


    // INSERT NEW REFERENCE
    function insertReference($reference, $request_id){
        $this->connection->query("
            INSERT INTO referrence_number(reference_number, request_id)
            VALUES('$reference','$request_id');
        ");
    }
}