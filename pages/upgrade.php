<?php
    $request_status = $user->checkActivationRequest($_COOKIE["uid"]);
?>
<section>
    <!-- Sub header -->
    <header class="sub-header">
        <h3 class="h3 text-center">
            <svg width="55px" height="55px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path fill="rgb(250, 180, 3)" d="M256 29.816l-231 154v106.368l231-154 231 154V183.816zm0 128.043L105 259.783v90.283l151-101.925 151 101.925v-90.283zm0 112l-87 58.725v67.6l87-58 87 58v-67.6zm0 89.957l-87 58v64.368l87-58 87 58v-64.368z"/></svg>
            Account upgrade
        </h3>
    </header>

    <section class="upgrade-details">
        <h2 class="h5">Need more energy? ⚡ <br> Upgrade your account now and keep earning bigger rewards!</h2>
        <p id="upgrade-price">₱50 Only/<span>Onetime payment</span> </p>
        <p id="">Boost your energy by +10 ⚡ daily! Complete more tasks & earn bigger rewards! </p>

        <?php
            if(!$request_status){
                echo '
                    <div class="qr-container">
                        <p class="h4 mb-3">Scan to Pay</p>
                        <img  src="./assets/img/qr-payment.jpg" alt="" id="payment-qr">
                        <br>
                        <button class="mt-5" id="upload-btn">
                            Upload Receipt
                        </button>
                    </div>
                ';
            }else if($request_status["status"] == "1"){
                echo '
                    <div>
                        <h1 class="h4 mt-5">You account was successfully upgraded!</h1>
                    </div>
                ';
            }else if($request_status["status"] == "0"){
                echo '
                    <div>
                        <h1 class="h4 mt-5">Upgrade request successfully sent! Verification will be completed within 24 hours. Please wait patiently. Thank you</h1>
                    </div>
                ';
            }
        ?>
         <p class="mt-5 text-center"><b>Need some help?</b> <br> You can contact our <a href="https://web.facebook.com/profile.php?id=61573822996100" target="_blank">customer care</a></p>
    </section>
</section>

<!-- Modal -->
 <?php require("./components/payment-proof-modal.php") ?>

 <script src="./js/upgrade.js"></script>