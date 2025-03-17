<section id="user-management-page" class="pb-5">
    <section id="users" class="container">
        <section class="label-search-section">
            <h2 class="h2">Users List</h2>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="search-input" placeholder="Enter name/email/ID" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
            </div>
        </section>
        <hr>
        <section class="table-container" id="user-table-container">
            <table class="table table-hover" id="user-table">
                <thead class="sticky-table-header">
                    <tr class="table-dark">
                        <th>ID</th>
                        <th>registration date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Referral Code</th>
                        <th>Earn Balance</th>
                        <th>Energy</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="user-table-body">
                </tbody>
            </table>
        </section>
    </section>
</section>
<script src="./js/user-management.js"></script>