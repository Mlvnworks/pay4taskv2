<header class="" id="main-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3">Pay4Task</h1>

        <div class="d-flex gap-5 align-items-center" id="right">
            <div id="energy" onclick="<?= ($user->checkLogin() && $user->getUserData($_COOKIE["uid"])["status"] == "0")   ? 'showUpgradeModal()' : '' ?>">
                <p class="h2" id="lightning-icon"><i class="bi bi-lightning-charge"></i>  </p>
                <p id="energy-output"><?= !$user->checkLogin() ? '0' : number_format($user->getUserData($_COOKIE["uid"])["energy"]) ?></p>
            </div>
            <a id="pf-db-navigator" href="<?= $content === "dashboard" ? "./?c=profile" : "./?c=dashboard" ?>">
                <?php
                    include $content === "dashboard" ? "./assets/svg/profile_ic.svg" : "./assets/svg/dashboard_ic.svg"
                ?>
            </a>
        </div>
        
    </div>
</header>
