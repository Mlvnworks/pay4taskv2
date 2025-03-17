<?php
    $get_system_status = $system->getSystemSettings(1)["value"] === "0" ? "System actively running" : "System is not currently running.";
    $admin_size = $admin->size();
?>

<section id="system-data-page">
    <div class="data-container mt-3">
        <h5 class="h5"><?= $get_system_status ?></h5>
    </div>
    <div class="data-container mt-3">
        <div>
            <p class="h1"><?= $user->getSize() ?></p>
            <p>User/s</p>
        </div>
    </div>
    <div class="data-container mt-3">
        <div>
            <p class="h1"><?= $task->getSize() ?></p>
            <p>Active Task/s</p>
        </div>
    </div>
    <div class="data-container mt-3">
        <div>
            <p class="h1"><?= $admin_size ?></p>
            <p>Admin/s</p>
        </div>
    </div>
</section>