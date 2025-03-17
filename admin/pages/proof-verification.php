<?php
    $filter = isset($_GET["filter"]) ? $_GET["filter"] : 0;

    $proof_list = $task->getSubmittedProof($filter);
   
?>
<section id="proof-verification-page">
    <section  class="container">
        <section class="label-search-section mt-5">
            <div class="d-flex gap-2 align-items-center">
                <h2 class="h2">Submitted Proof</h2>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-warning btn-sm"> <a href="./?c=proof-verification&filter=0" class="text-decoration-none text-light">Pending</a></button>
                    <button type="button" class="btn btn-success btn-sm"><a href="./?c=proof-verification&filter=1" class="text-decoration-none text-light">Approved</a></button>
                    <button type="button" class="btn btn-danger btn-sm"><a href="./?c=proof-verification&filter=-1" class="text-decoration-none text-light">Declined</a></button>
                </div>
            </div>
            <div class="input-group mb-3 align-items-center">
                <input type="text" class="form-control" placeholder="Enter name/email/ID/Task ID" id="search-input" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
            </div>
            <button class="btn btn-success btn-sm" onclick="if(confirm('Are you sure you want to approve all?')) location.href='./?approve-all-proof';">Approve All</button>
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
                        <th>Task</th>
                        <th>Task Instruction</th>
                        <th>Task Reward</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php
                        if(count($proof_list) > 0){
                            
                            array_map(function($proof_item){
                                $task_id = $proof_item["task_id"] ? $proof_item["task_id"]: "[task-deleted]";
                                $task_instruction = $proof_item["task_instruction"] ? $proof_item["task_instruction"] : "[task-deleted]";

                                echo '
                                    <tr>
                                        <td>'. $proof_item["submission_id"] .'</td> 
                                        <td>'.  formatTimestamp($proof_item["date_submitted"]) .'</td>
                                        <td>'. $proof_item["name"] .'</td>
                                        <td>'. $proof_item["email"] .'</td>
                                        <td><a href="./?c=task-data&id='. $task_id .'" target="_blank">Task-'. $task_id .'</a></td>
                                        <td>'. $task_instruction .'</td>
                                        <td>'. $proof_item["task_reward"] .'</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary view-proof-btn" data-bs-toggle="modal"  data-bs-target="#submitted-proof-modal" data-proof-id="'. $proof_item["proof_file_id"] .'" data-submission-id="'. $proof_item["submission_id"] .'">View Proof</button>
                                        </td>
                                    </tr>
                                ';

                            }, $proof_list);
                        }else{
                            echo '
                                <tr>
                                    <td colspan="7" class="text-center">No proof to show</td>
                                </tr>
                            ';
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </section>
</section>

<!-- Modal -->
 <?php include "./components/submitted-proof-modal.html" ?>
 <script src="./js/proof-verification.js"></script>