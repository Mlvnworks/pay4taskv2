<?php
        $user_data = $user->getUserData(filterValue($_GET["id"]));
        $invited_by = $user->whoReferred($user_data["referral_used"]);
        $referred_count = number_format($user->getReferredCount($user_data["user_id"]));

        $histories = $user->getHistory($user_data["user_id"]);
?>

<section id="profile-page" class="pb-5">
    <section id="user-data" class= "data mt-5">
        <section class="data-container shadow-sm first-box" id="user-primary-data">
            <h3 class="text-center mb-3 first-box">User Details</h3>
            <div class="mt-3">
                <label class="mb-1">ID</label>
                <input type="text" name="" id="" value="<?= $user_data["user_id"] ?>"  class="form-control" readonly>
            </div class="mt-3">
            <div class="mt-3">
                <label class="mb-1">Name</label>
                <input type="text" name="" id="" value="<?= $user_data["name"] ?>" class="form-control" readonly>
            </div class="mt-3">
            <div class="mt-3">
                <label class="mb-1">Email</label>
                <input type="text" name="" id="" value="<?= $user_data["email"]?>"  class="form-control"readonly>
            </div class="mt-3">
            <div class="mt-3">
                <label class="mb-1">Referral Code</label>
                <input type="text" name="" id="" value="<?= $user_data["referral_code"] ?>"  class="form-control" readonly>
            </div>
            <div class="mt-3">
                <label class="mb-1">Referred By</label>
                <input type="text" name="" id="" value="<?= $invited_by ?>"  class="form-control" readonly>
            </div>
        </section>

        <section class="data-container shadow-sm second-box" id="user-referral">
            <h3 class="text-center mb-3 ">Referral</h3>
            <div class="text-center">
                <p class="fs-1"><?= $referred_count ?></p>
                <small> Total Refferal</small>
            </div>
        </section>
        <section class="data-container shadow-sm third-box" id="user-history">
            <h3 class="text-center mb-3">History</h3>
            <section class="histories-list">
                <?php 
                        if(count($histories) > 0){
                                foreach($histories as $history){
                                        echo '
                                                <div class="mt-4 history-item">
                                                        <p>'. $history["text"] .'</p>
                                                        <small>'. formatTimestamp($history["datetime"]) .'</small>
                                                </div>
                                        ';
                                }
                        }else{
                                echo '
                                        <div class="mt-4 history-item">
                                                <p class="text-center" >No history to show</p>
                                        </div>
                                ';
                        }
                        
                ?>
            </section>
        </section>
    </section>
</section>
