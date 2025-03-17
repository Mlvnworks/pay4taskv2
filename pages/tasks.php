<?php
    $active_tasks_list = $task->getActiveTask($_COOKIE["uid"]);
?>

<section>
    <!-- Sub header -->
    <header class="sub-header">
        <h3 class="h3 text-center">
            <?php include "./assets/svg/tasks_ic.svg"?>
            Tasks
        </h3>
    </header>

    <!--  -->
    <section class="task-count-details">
        <div id="task-help">
            <?php include "./assets/svg/question_mark_ic.svg"?>
            <span id="question-title">Please stay tune for new tasks!</span>
        </div>
        <p id="task-count"><?= number_format(count($task->getActiveTask($_COOKIE["uid"]))) ?></p>
        <small class="text-dark fw-bold">Available Task/s</small>
    </section>

    <!-- Tasks Lists -->
    <section class="task-list">

        <!-- task Item -->
         <?php  
            if(count($active_tasks_list) > 0){
                array_map(function($task_item){
                    echo '<div class="task-item">
                            <div class="task-img-container">
                                <img src="./tools/fetchImage.php?id='. $task_item["task_img"].'" alt="'. $task_item["task_instruction"].'" loading="lazy" >
                            </div>
                            <div>
                                <div class="task-details d-flex justify-content-between">
                                    <div>
                                        <p class="task-instruction-label">Instuction:</p>
                                        <p class="task-inctruction">'. $task_item["task_instruction"].'</p>       
                                    </div>
                                    <div>
                                        <p class="task-date">'. formatTimestamp($task_item["created_datetime"]) .'</p>
                                        <p class="task-reward  text-end">'. toCurrencySign($task_item["task_reward"]).'</p>
                                    </div>
                                </div>      
                            </div>
                            <div class="text-center mt-3 d-flex gap-3 justify-content-evenly">
                                    <button class="start-task-btn " onclick="window.open(`'. $task_item["task_link"].'`)">Start Task</button>
                                <button class="submitted-proof-btn" data-task-id="'. $task_item["task_id"]  .'">Submit proof</button>
                            </div>
                        </div>';
                }, $active_tasks_list);
            }else{
                echo '
                    <h4 class="text-center mt-5 text-secondary">No available task for you this time</h4>
                ';
            }
           
         ?>
    </section>
</section>

<?php include "./components/submit-proof-modal.html" ?>

<script>
    const qmIcon = document.getElementById('task-help');
    const submitProofBtns = document.querySelectorAll('.submitted-proof-btn');


    submitProofBtns.forEach(btn => {
        btn.addEventListener('click', (ev) => {
            const modal = document.querySelector("#submit-proof-modal");
            const taskIdInput = document.querySelector("#task-id-input");
            taskIdInput.value = ev.target.getAttribute("data-task-id");
            modal.style.display = 'flex';
        });
    });

    qmIcon.addEventListener('click', () => {
        const questionTitle = document.getElementById('question-title');
        const state = questionTitle.style.display === 'none' || questionTitle.style.display === '' ? 'block' : 'none';
        questionTitle.style.display = state;
         
        setTimeout(() => {
            questionTitle.style.display = 'none';
        }, 5000);
    });
</script>