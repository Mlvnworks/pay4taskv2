<?php
    $filter = isset($_GET["filter"]) ? $_GET["filter"] : 0;

    $transfer_requests = $system->getTransferRequests($filter);
?>

<section id="proof-verification-page">
    <section  class="container">
        <section class="label-search-section mt-5">
            <div class="d-flex gap-2 align-items-center">
                <h2 class="h2">Transfer Requests</h2>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-warning btn-sm"> <a href="./?c=transfer&filter=0" class="text-decoration-none text-light">Pending</a></button>
                    <button type="button" class="btn btn-success btn-sm"><a href="./?c=transfer&filter=1" class="text-decoration-none text-light">Approved</a></button>
                    <button type="button" class="btn btn-danger btn-sm"><a href="./?c=transfer&filter=-1" class="text-decoration-none text-light">Declined</a></button>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter name/email/ID" id="search-input" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
                        <th>Method</th>
                        <th>Account</th>
                        <th>Amount</th>
                        <th>User status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php
                        if(count($transfer_requests) > 0){
                            
                            array_map(function($request){
                                $user_status = $request["user_status"] == "1" ? "Active": "";

                                echo '
                                    <tr>
                                        <td>'. $request["request_id"] .'</td> 
                                        <td>'.  formatTimestamp($request["request_date"]) .'</td>
                                        <td> <a href="./?c=user-profile&id='. $request["user_id"] .'">'. $request["name"] .'</a></td>
                                        <td><a href="./?c=user-profile&id='. $request["user_id"] .'">'. $request["email"] .'</a></td>
                                        <td>'. $request["method"] .'</td>
                                        <td>'. $request["account"] .'</td>
                                        <td>'. toCurrencySign($request["amount"]) .'</td>
                                        <td>'. $user_status .'</td>
                                        <td>
                                            <a href="./?update-transfer-request='. $request["request_id"] .'&status=-1" class="action-btn" data-action="decline">
                                                 <button class="btn btn-sm btn-danger view-proof-btn">Decline</button>
                                            </a>
                                            <a href="./?update-transfer-request='. $request["request_id"] .'&status=1" class="action-btn" data-action="approve">
                                                 <button class="btn btn-sm btn-success view-proof-btn">Approve</button>
                                            </a>
                                        </td>
                                    </tr>
                                ';

                            }, $transfer_requests);
                        }else{
                            echo '
                                <tr>
                                    <td colspan="9" class="text-center">No transfer request to show</td>
                                </tr>
                            ';
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </section>
</section>
<script src="./js/transfer.js"></script>