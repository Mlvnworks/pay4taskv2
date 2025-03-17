<?php
    // REDIRECT IF THE ID IS NOT SET
    if(!isset($_GET["id"]) || $_GET["id"] === "") {
        header("Location: ./?c=tasks-management");
        exit();
    }

    $task_data = $task->getTaskData(filterValue($_GET["id"]));
    
    // REDIRECT IF THE TASK IS NOT EXIST
    if(!$task_data) {
        header("Location: ./?c=tasks-management");
        exit();
    }

    // CHANGE STATUS BUTTON CLASS
    $change_status_btn = $task_data["status"] == "-1" ? 
                                        ["text" => "Mark as available", "class" => "btn-success" ] :
                                        ["text" => "Mark as un-available", "class" => "btn-warning"];
    
?>
<section id="task-data-page" class="pb-5">
    <div class="d-flex  justify-content-center gap-5 mt-5">
        <a href="./?delete-task=<?= $task_data["task_id"] ?>" id="delete-task-link"><button class="btn btn-danger" id="delete-btn">Delete Task</button></a>   
        <a href="./?set-task-status=<?= $task_data["task_id"] ?>" id="submit-status-change"><button class="btn <?= $change_status_btn["class"] ?>" id="change-status-btn"><?= $change_status_btn["text"] ?></button></a>
        <button class="btn btn-primary" onclick="if(confirm('Are you sure you want to repost?')) location.href = './?repost-task=<?=  $task_data['task_id'] ?>'">Re-post</button>
    </div>
    <section id="task-data" class="data mt-5">
        <section class="data-container shadow-sm first-box" >
            <h3 class="text-center mb-3">Task Details</h3>
            <form action="./" method="POST" id="task-details-form">
                <div class="mt-3">
                    <label class="mb-1">ID</label>
                    <input type="text" name="edit-task-details" id="" value="<?= $task_data["task_id"] ?>"  class="form-control" readonly>
                </div class="mt-3">
                <div class="mt-3">
                    <label class="mb-1">Date Created</label>
                    <input type="text" name="date-create" id="" value="<?= formatTimestamp($task_data["created_datetime"]) ?>"  class="form-control" readonly>
                </div class="mt-3">
                <div class="mt-3">
                    <label class="mb-1">Task Instruction</label>
                    <input type="text" name="instruction" id=""  value="<?= $task_data["task_instruction"] ?>"  class="form-control task-detail-input" readonly required>
                </div class="mt-3">
                <div class="mt-3">
                    <label class="mb-1">Application</label>
                    <select name="app" id="" class="form-control task-detail-input" value="<?= $task_data["task_app"] ?>" readonly required>
                        <option value="facebook">Facebook</option>
                        <option value="tiktok">TikTok</option>
                        <option value="youtube">Youtube</option>
                    </select>
                </div class="mt-3">
                <div class="mt-3">
                    <label class="mb-1">Destination</label>
                    <input type="text" name="link" id=""  value="<?= $task_data["task_link"] ?>"  class="form-control task-detail-input" readonly required>
                </div class="mt-3">

                <div class="mt-3">
                    <label class="mb-1">Reward P</label>
                    <input type="text" name="reward" id="" value="<?= $task_data["task_reward"] ?>"  class="form-control task-detail-input" readonly required>
                </div class="mt-3">
                <div class="mt-3">
                    <label class="mb-1">Max Spent P(Optional)</label>
                    <input type="number" name="max-reward" id="" steps="0.01"  value="<?= $task_data["max_reward"] == "-1.00" ? "" : $task_data["max_reward"] ?>"  class="form-control task-detail-input" readonly>
                </div class="mt-3">
                <div class="mt-3">
                    <label class="mb-1">Date end (Optional )</label>
                    <input type="date" name="expiration" id="" value="<?= $task_data["expiration"] == "-1" ? "" : date('Y-m-d', $task_data["expiration"]) ?>"  class="form-control task-detail-input" readonly>
                </div class="mt-3">

                <button class="btn btn-success mt-3 w-100 d-none" id="save-btn">Save</button>
                <button class="btn btn-primary mt-2 w-100" type="button" id="edit-details-btn">Edit</button>
            </form>
        </section>
        <section class="data-container second-box" >
            <h3 class="text-center mb-3">Thumbnail</h3>
            <div class="thumbnail-container">
                <img src="../tools/fetchImage.php?id=<?= $task_data["task_img"] ?>" alt="">
            </div>
            <div id="drag-drop-area" class="d-none">
                <div>
                    <div class="thumbnail-container d-none">
                      <img src="../assets/img/test-task-img.png" id="thumbnail-preview" alt="">
                  </div>
                    <form action="./" method="POST" id="change-thumbnail-form" enctype="multipart/form-data">
                        <input type="hidden" name="change-thumbnail" value="<?= $task_data["task_id"] ?>">
                        <input type="file" name="thumbnail" class="opacity-0" style="position:absolute;" id="change-thumbnail-input" accept="image/*" required>
                        <button class="d-none" id="change-thumbnail-submit-btn"></button>
                    </form>
                    <button class="btn btn-secondary" id="select-thumbnail-btn">Select</button>
                </div>
            </div>
            <button class="btn btn-success w-100 d-none mt-3" id="save-thumbnail-btn" >Save</button>
            <button class="btn btn-primary mt-1 w-100" id="change-thumbnail-btn">Change</button>
        </section>
        <section class="data-container shadow-sm third-box" >
            <h3 class="text-center mb-3">Submitted Proof</h3>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter user-Name/Email/ID" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
            </div>
            <hr>
            <section class="submitted-proof-list">
                <div class="submitted-proof-item">
                    <p>Melvin <a href="#">#792wjs272</a></p>
                    <small class="text-secondary">10/23/25</small>
                </div>
                <div class="submitted-proof-item">
                    <p>Melvin <a href="#">#792wjs272</a></p>
                    <small class="text-secondary">10/23/25</small>
                </div>
                <div class="submitted-proof-item">
                    <p>Melvin <a href="#">#792wjs272</a></p>
                    <small class="text-secondary">10/23/25</small>
                </div>
            </section>
        </section>
    </section>
</section>
<script src="./js/task-data.js"></script>