<?php
    $admin_list = $admin->get_list();
    $system_maintenance_state = $system->getSystemSettings(1)["value"] === "0" ? "Off" : "On";
    $checked = $system_maintenance_state === "On";
    
?>

<section id="system-config-page" class="pt-5 pb-5">
    <section class="container">
        <div class="data-container">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="h5">System Maintenance</h5>
                <div>
                    <input type="checkbox" class="btn-check" autocomplete="off" id="cb-system-maintenance" <?= $checked ? 'checked' : '' ?>>
                    <label class="btn btn-outline-primary" for="cb-system-maintenance" id="system-maintenance-state"><?= $system_maintenance_state ?></label>
                </div>
            </div>
        </div>
        <div class="data-container mt-5">
            <div class="">
                <h5 class="h5" contenteditable="true">Admin Access List</h5>
                <table class="table mt-5 w-100" id="admin-table">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Device</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($admin_list as $admin){
                                $admin_id = $admin["admin_id"];
                                $admin_name = $admin["name"] === "" ? "not-set" : $admin["name"];

                                echo '
                                    <tr class="admin-item">
                                        <td class="admin-name">'. $admin_name .'</td>
                                        <td>Device-'. $admin["device"] .'</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm edit-btn" data-admin="'.$admin_id.'">Edit</button>
                                            <button class="btn btn-danger btn-sm remove-btn" data-admin="'.$admin_id.'">Remove</button>
                                        </td>
                                    </tr>
                                ';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</section>
<script src="./js/system-configuration.js"></script>