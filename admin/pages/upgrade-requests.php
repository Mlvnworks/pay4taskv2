<?php
    $filter = isset($_GET["filter"]) ? $_GET["filter"] : 0;

    $upgrade_requests = $system->getUpgradeRequests($filter);
?>
<section id="proof-verification-page">
    <section  class="container">
        <section class="label-search-section mt-5">
            <div class="d-flex gap-2 align-items-center">
                <h2 class="h2">Upgrade requests</h2>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-warning btn-sm"> <a href="./?c=upgrade-requests&filter=0" class="text-decoration-none text-light">Pending</a></button>
                    <button type="button" class="btn btn-success btn-sm"><a href="./?c=upgrade-requests&filter=1" class="text-decoration-none text-light">Approved</a></button>
                    <button type="button" class="btn btn-danger btn-sm"><a href="./?c=upgrade-requests&filter=-1" class="text-decoration-none text-light">Declined</a></button>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter name/email/ID/Task ID" id="search-input" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
            </div>
        </section>
        <hr>
        <section class="proof-verification-list-container table-container">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Date & Time</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Receipt</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php
                    
                        if(count($upgrade_requests) > 0){
                            array_map(function($upgrade_item){
                                echo '
                                    <tr>
                                        <td>'. $upgrade_item["request_id"] .'</td> 
                                        <td>'. formatTimestamp($upgrade_item["datetime"]) .'</td>
                                        <td>'. $upgrade_item["name"] .'</td>
                                        <td>'. $upgrade_item["email"] .'</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary view-receipt-btn" data-bs-toggle="modal" data-bs-target="#receipt-modal" data-src="../tools/fetchImage.php?id='. $upgrade_item["receipt_id"] .'">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger view-proof-btn action-btn" data-href="./?update-upgrade-request='. $upgrade_item["request_id"] .'&action=-1" data-action="decline">Decline</button>
                                            <button class="btn btn-sm btn-success check-payment-btn" data-bs-toggle="modal" data-bs-target="#reference-number-modal" data-id="'. $upgrade_item["request_id"] .'">Approve</button>
                                        </td>
                                    </tr>
                                ';
                            }, $upgrade_requests);

                        }else{
                            echo '<tr>
                                    <td colspan="6" class="text-center">No request to show</td> 
                                </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </section>
</section>

<!-- MODAL -->
<?php require("./components/view-receipt-modal.php") ?>
<?php require("./components/enter-reference-modal.php") ?>

<script src="./js/upgrade-requests.js"></script>