<?php
    $user_data = $user->getUserData($_COOKIE["uid"]);
    $request_transfer_list = $user->getTransferRequest($_COOKIE["uid"]);

?>
 <section>
    <!-- Sub header -->
    <header class="sub-header">
        <h3 class="h3 text-center">
            <?php include "./assets/svg/transfer_ic.svg"?>
            Transfer
        </h3>
    </header>

    <!-- Card -->
    <div class="card mt-5">
        <p class="card-label">
            Earning
        </p>
        <div class="card-content">
            <p><?= toCurrencySign($user_data["earning"]) ?></p>
        </div>
    </div>

    <!-- Account detail of payment, form -->
    <form id="transfer-form" action="./" method="POST">
        <input type="hidden" name="request-transfer" id="method">
        <input type="text" name="account" id="account-input" class="d-none" >
        <input type="text" name="amount" id="amount" value="<?= $user_data["earning"] ?>" class="d-none" readonly>

        <section id="payment-method" class="d-flex justify-content-evenly align-items-center">
            <div class="payment-method-item active-payment-method" data-method="gcash">
                <div>
                    <?php include "./assets/svg/gcash_ic.svg"?>
                    <p>Gcash</p>
                </div>
            </div>
            <div class="payment-method-item" data-method="paypal">
                <div>
                    <?php include "./assets/svg/paypal_ic.svg"?>
                    <p>Paypal</p>    
                </div>
            </div>
        </section>

        <section id="transfer-method" class="mt-5">
            <input type="text" class="form-control mt-4" placeholder="Gcash Number" required>
            <input type="text" class="form-control mt-4" placeholder="Gcash Name" required>
        </section>

        <section id="transfer-btn-container" class="mt-4">
            <small><?php include "./assets/svg/exclamation_ic.svg"?>The minimum amount is ₱10</small>
            <br>
            <button id="transfer-btn" class="btn w-100 mt-2" <?= ($user_data["earning"] * 1) >= 10 ? "" : "disabled" ?>>Transfer</button>
        </section>
    </form>


    <!-- Cashout History -->
     <section id="transfer-history">
        <header>
            <h3 class="h3 text-center">Transfer History</h3>
        </header>

        <!-- Hostory list -->
         <section class="hostory-list">
            <!-- History Item  -->
             <?php
                if(count($request_transfer_list) > 0){
                    array_map(function($request){
                        $status_text = $request["status"] == "1" ? "Success" : ($request["status"] == "-1" ? "Failed" : "Processing"); 
                        $method = $request["method"] == "gcash" ? "Gcash Transfer" : "Paypal Transfer";

                        echo '
                            <div class="history-list-item d-flex justify-content-between align-items-start pb-2" >
                                <div>
                                    <p class="method">'. $method .'</p>
                                    <p class="account-details">'. $request["account"] .'</p>
                                </div>
                                <div class="text-end">
                                    <p class="amount">'. toCurrencySign($request["amount"]) .'</p>
                                    <small class="date">'. formatTimestamp($request["request_date"]) .'</small>
                                    <br>
                                    <small class="status">'. $status_text .'</small>
                                </div>
                            </div>
                        ';
                    }, $request_transfer_list);
                }else{
                    echo '<h4 class="text-center mt-5 text-secondary">No request to show</h4>';
                }
                
             ?>
            
            <!-- <div class="history-list-item d-flex justify-content-between align-items-start pb-2">
                <div>
                    <p class="method">Gcash Transfer</p>
                    <p class="account-details">09664525291</p>
                </div>
                <div class="text-end">
                    <p class="amount">- ₱5.0</p>
                    <small class="date">30/01/2025</small>
                    <br>
                    <small class="status">Completed</small>
                </div>
            </div> -->
            
         </section>
     </section>
</section>

<script src="./js/transaction-method.js"></script>
<script src="./js/transfer.js"></script>