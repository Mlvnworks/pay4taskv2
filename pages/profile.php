<?php
    $user_data = $user->getUserData($_COOKIE["uid"]);
    $activities = $user->getActivities($_COOKIE["uid"]);
?>
<section class="pb-5">
    <!-- Sub header -->
    <header class="sub-header">
        <h3 class="h3 text-center">
        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M24.6603 45.8307L25 45.8334C24.5401 45.8333 24.0802 45.8183 23.6213 45.7885C23.0533 45.7513 22.4871 45.691 21.924 45.6078C21.2699 45.5109 20.6207 45.3829 19.9788 45.2242C19.346 45.0676 18.721 44.8812 18.1058 44.6656L18.1023 44.6643C17.0892 44.309 16.1053 43.8754 15.1595 43.3675C14.4882 43.0071 13.8372 42.61 13.2095 42.1782C12.5036 41.6928 11.8282 41.1645 11.1871 40.5962C10.9631 40.3977 10.7434 40.1944 10.5281 39.9865C6.60575 36.1978 4.16669 30.8838 4.16669 25C4.16669 13.4941 13.4941 4.16669 25 4.16669C27.7359 4.16667 30.445 4.70553 32.9726 5.7525C35.5002 6.79947 37.7969 8.33403 39.7314 10.2686C41.666 12.2031 43.2006 14.4998 44.2475 17.0274C45.2945 19.555 45.8334 22.2641 45.8334 25C45.8334 30.884 43.3941 36.1982 39.4717 39.9867C39.4715 39.987 39.4715 39.9874 39.4717 39.9879C38.4849 40.9404 37.407 41.7937 36.2535 42.5355L36.2374 42.5458C35.9758 42.7138 35.7105 42.8759 35.4415 43.0318L35.4131 43.0484C34.9425 43.3203 34.4616 43.5738 33.9713 43.8082C33.7794 43.8996 33.5862 43.9883 33.3917 44.0742C33.1888 44.1634 32.9846 44.2495 32.7792 44.3325C32.58 44.4125 32.3796 44.4896 32.1781 44.5638C31.9744 44.6383 31.7697 44.7098 31.5639 44.7783C31.3615 44.8452 31.1582 44.9092 30.954 44.9701C30.7376 45.0344 30.5202 45.0953 30.3019 45.1527C30.0895 45.2084 29.8762 45.2607 29.6621 45.3098C29.4485 45.3585 29.2341 45.4039 29.0191 45.446C28.1427 45.6173 27.2561 45.732 26.3649 45.7893C26.1434 45.8037 25.9217 45.8145 25.6999 45.8219L25.6956 45.822C25.3506 45.8333 25.0054 45.8362 24.6603 45.8307ZM27.0834 33.3334H22.9167C19.598 33.3334 16.6956 35.2862 15.3613 38.1416L15.2104 38.4875L15.341 38.5841C17.7156 40.2755 20.5526 41.36 23.6256 41.6108C23.7173 41.6183 23.8092 41.6251 23.9014 41.631L23.6383 41.6118C23.7278 41.6191 23.8175 41.6256 23.9074 41.6314L23.9014 41.631C23.9904 41.6369 24.0796 41.642 24.1689 41.6464L23.9074 41.6314C24.0002 41.6375 24.0932 41.6427 24.1865 41.6472L24.1689 41.6464C24.2359 41.6496 24.3029 41.6525 24.3699 41.655L25 41.6667L25.2612 41.6647C25.3573 41.6633 25.4533 41.661 25.5493 41.6579L25.2856 41.6642C25.3745 41.6628 25.4632 41.6606 25.5517 41.6577L25.5493 41.6578C25.6386 41.6549 25.7277 41.6514 25.8167 41.6471L25.5517 41.6577C25.6435 41.6546 25.7353 41.651 25.827 41.6465L25.8167 41.6471C25.9094 41.6425 26.0018 41.6373 26.094 41.6314L25.827 41.6465C25.9173 41.6421 26.0075 41.637 26.0975 41.6311L26.0941 41.6313C26.1844 41.6255 26.2744 41.6189 26.3642 41.6117L26.0975 41.6311C26.1892 41.6252 26.2809 41.6184 26.3725 41.611L26.3642 41.6117C26.4515 41.6045 26.5385 41.5968 26.6254 41.5885L26.3725 41.611C26.4637 41.6036 26.5546 41.5954 26.6454 41.5865L26.6254 41.5885C29.5957 41.301 32.3379 40.2338 34.6448 38.5941L34.7875 38.4875L34.6389 38.142C33.363 35.4107 30.6518 33.5049 27.5139 33.3443L27.0834 33.3334ZM25 8.33339C15.7953 8.33339 8.33339 15.7953 8.33339 25C8.33339 28.975 9.72489 32.625 12.0474 35.4892C14.1985 31.7127 18.2602 29.1667 22.9167 29.1667H27.0834C31.7399 29.1667 35.8017 31.7129 37.9525 35.489C40.2751 32.625 41.6667 28.975 41.6667 25C41.6667 15.7953 34.2048 8.33339 25 8.33339ZM25 10.4167C29.6024 10.4167 33.3334 14.1476 33.3334 18.75C33.3334 23.2129 29.8251 26.8564 25.4159 27.0732L25 27.0834C20.3976 27.0834 16.6667 23.3524 16.6667 18.75C16.6667 14.2871 20.175 10.6435 24.5841 10.4268L25 10.4167ZM25 14.5834C22.6988 14.5834 20.8334 16.4488 20.8334 18.75C20.8334 21.0512 22.6988 22.9167 25 22.9167C27.3012 22.9167 29.1667 21.0512 29.1667 18.75C29.1667 16.4488 27.3012 14.5834 25 14.5834Z" fill="rgb(250, 180, 3)"/>
        </svg>

            Profile
        </h3>
    </header>
    <!--  -->
        <div class="card-content">
            <div>
                <?= $user_data["status"] == "1" ? '<p id="upgraded-label">Upgraded</p>' : '' ?>
                <p id="user-name"><?= $user_data["name"] === ""? "not-set" : $user_data["name"] ?> </p>
                <p><?= $user_data["email"] ?></p>
                <div>
                    <h2 class="h2"> ₱30 <small style="font-size: 12px;">/upgraded invite</small></h2>
                    <p>Get ₱30 reward for every activated invites</p>
                    <p>Invitation link: <br/> <small id="ref-link">https://pay4task.app/?create-account&ref=<?= $user_data["referral_code"] ?></small> 
                        <button class="btn" onclick="onCopy(`#ref-link`, this)"><?php include "./assets/svg/copy_ic.svg"?></button>
                        <span id="copy-check" class="d-none btn"><i class="bi bi-check"></i></span>
                    </p>
                    
                    <div>
                        <h1 class="h1 mt-5" style="color: var(--primary)"><?= number_format($user->getReferredCount($_COOKIE["uid"])) ?></h1>
                        <p class="small text-secondary">Total invite/s</p>
                        <a href="./?c=referral" class="pt-3">View list</a>
                    </div>
                </div>
                <button class="btn w-100  mt-3" id="btn-logout"  onclick="location.href='./?logout';"> Log out</button>
            </div>
        </div>


   <!-- Tasks activity section -->
    <section class="task-activities">
        <h3 class="h3 text-center">Task Activities</h3>
         <!-- Tasks Lists -->
        <section class="task-activity-list">
        <?php
            array_map(function($activity){
                $text_status = ($activity["status"] == 0) ? "Verifying" : (($activity["status"] == -1) ? "Invalid" : "Success");
                $status_class = ($activity["status"] == 0) ? "text-warning" : (($activity["status"] == -1 ) ? "text-danger" : "text-success");
                
                $thumbnail_content = !$activity["task_img"] ? '<h1 class="h5  text-secondary opacity-50 pt-5 text-center">[Task Deleted]</h1>' : '<img src="./tools/fetchImage.php?id='. $activity["task_img"] .'" alt="" loading="lazy">';
                $instruction = !$activity["task_instruction"] ? "[un-available]" : $activity["task_instruction"];
                $task_reward = !$activity["task_reward"] ?  "[un-available]" : toCurrencySign($activity["task_reward"]);
               
                echo '
                    <div class="task-item">
                        <div class="task-img-container">
                            '. $thumbnail_content .'
                        </div>
                        <div>
                            <div class="task-details d-flex justify-content-between">
                                <div>
                                    <p class="task-instruction-label">Instuction:</p>
                                    <p class="task-inctruction">'. $instruction .'</p>
                                </div>
                                <div>
                                    <p class="task-date">' . formatTimestamp($activity["date_submitted"]) . '</p>
                                    <p class="task-status '. $status_class .'">'. $text_status .'</p>
                                    <p class="task-reward">'. $task_reward .'</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button class="submitted-proof-btn" data-file-id="'. $activity["proof_file_id"] .'" >Submitted Proof</button>
                        </div>
                    </div>
                ';
            }, $activities);
        ?>
        </section>
    </section>
</section>
<!-- modal -->
 <?php include "./components/view-submitted-proof-modal.html"?>
<script src="./js/profile.js"></script>