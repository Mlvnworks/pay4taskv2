<?php
    $is_login = $user->checkLogin();
    
    $user_data = $is_login ? [...$user->getUserData($_COOKIE["uid"]), "tasks_count" => number_format(count($task->getActiveTask($_COOKIE["uid"])))] : [
        "earning" => toCurrencySign(0),
        "tasks_count" => number_format($task->getSize())
    ];
?>

<section>
    <!-- Sub header -->
    <header class="sub-header">
        <h3 class="h3 text-center">
            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M27.0833 18.75V6.25H43.75V18.75H27.0833ZM6.25 27.0833V6.25H22.9167V27.0833H6.25ZM27.0833 43.75V22.9167H43.75V43.75H27.0833ZM6.25 43.75V31.25H22.9167V43.75H6.25ZM10.4167 22.9167H18.75V10.4167H10.4167V22.9167ZM31.25 39.5833H39.5833V27.0833H31.25V39.5833ZM31.25 14.5833H39.5833V10.4167H31.25V14.5833ZM10.4167 39.5833H18.75V35.4167H10.4167V39.5833Z" fill="rgb(250, 180, 3)"/>
            </svg>
            Dashboard
        </h3>
    </header>
    <!-- -->
    <section class="d-flex justify-content-evenly" id="card-section">
        <section>
             <div class="card">
                <p class="card-label">
                    Earning
                </p>
                <div class="card-content">
                    <p><?= toCurrencySign($user_data["earning"]) ?></p>
                </div>
            </div>
            <div>
                <button class="card-action" id="transfer-btn">Transfer</button>
            </div>
        </section>
       <section>
            <div class="card">
                <p class="card-label">
                    Task(s)
                </p>
                <div class="card-content">
                    <p><?= $user_data["tasks_count"] ?></p>
                </div>
            </div>
            <div>
                <button class="card-action" id="start-task-btn">Start Task</button>
            </div>
       </section>
    </section>
     <p class="mt-5 text-center"><b>Need some help?</b> <br> You can contact our <a href="https://web.facebook.com/profile.php?id=61573822996100" target="_blank">customer care</a></p>
</section>
<script>
    // OPEN LOGIN MODAL IF THE USER IS NOT LOGED IN
    <?= !$user->checkLogin() ? 'openModal();' : ''   ?>
    const isLogin = <?= !$user->checkLogin() ? 'false' : 'true'  ?>;
    const profileDashboardNavigator =document.querySelector("#pf-db-navigator")

    
    if(profileDashboardNavigator.href === "http://localhost/pay4task/?c=profile" && !isLogin){
        profileDashboardNavigator.addEventListener('click', function(event) {
            event.preventDefault();
            openModal();
        }); 
    }
    
</script>
<script src="./js/dashboard.js"></script>

