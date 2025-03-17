<section id="user-management-page" class="pb-5">
    <section id="users" class="container">
        <section class="label-search-section">
            <div class="d-flex gap-3 align-items-center">
                <h2 class="h2">Tasks List</h2>
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#new-task-modal">New</button>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter App/Instruction/ID" id="search-input" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
            </div>
        </section>
        <hr>
        <section class="table-container" id="task-table-container">
            <table class="table table-hover">
                <thead class="sticky-table-header">
                    <tr class="table-dark">
                        <th>ID</th>
                        <th>Date Added</th>
                        <th>Task Instruction</th>
                        <th>App</th>
                        <th>Destination</th>
                        <th>Overall Spent</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="table-body">
                </tbody>
            </table>
        </section>
    </section>
</section>
<!-- New Task Modal -->
 <?php include "./components/new-task-modal.html"?>
<script src="./js/tasks-management.js"></script>