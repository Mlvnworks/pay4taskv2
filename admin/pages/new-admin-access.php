<?php
    // Check if the review id is setted
    if(!isset($_GET["id"])){
        header("Location: ../");
        exit();
    }


    try{   
        $review_id = $_GET["id"];
        $review_data = $admin->review($review_id);

         
        // IF THE REQUEST RETURN 0 DATA
        if(!$review_data){
            echo '<h2 class="h5 mt-5 text-center m">Request not found, the link might expired.</h2>'; 
            die();
        }
        
        // CHECK IF THE LINK IS EXPIRED
        $is_expired = ($review_data["expiration_time"] * 1) <= time();
       if($is_expired){
            $admin->reviewAction($review_data["admin_id"], -1);
            echo '<h2 class="h5 mt-5 text-center m">Link already Expired</h2>'; 
            die();
       }

    }catch(Exception $err){
        print($err);
        die();
    }
?>

<section class="data-container mt-5">
    
    <section id="new-admin-access-page">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h5">New access</h2>
            <small><?=  formatTimestamp($review_data["request_date"] * 1) ?></small>
        </div>
        <div>
            <p><b>Device:</b><br><?= $review_data["device"]?></p>
            <div class="text-end">
                <button class="btn btn-danger" id="decline-btn">Decline</button>
                <button class="btn btn-success" id="allow-btn">Allow</button>
            </div>
        </div>
    </section>
</section>
<div class="d-none" id="bridge" data="<?= $review_data["admin_id"] ?>"></div>
<script src="./js/new-admin-access.js"></script>