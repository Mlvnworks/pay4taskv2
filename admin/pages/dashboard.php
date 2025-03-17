<section id="dashboard-page" class="pb-5">
     <!-- Navigation section -->
      <section id="navigation">
        <div class="shadow-sm navigation-item" data-link="./?c=user-management">
            <i  class="bi bi-people navigation-item-icon"></i>
            <h6 class="h6">User Management</h6>
        </div>
        <div class="shadow-sm navigation-item" data-link="./?c=tasks-management">
            <i  class="bi bi-list-task navigation-item-icon"></i>
            <h6 class="h6">Tasks Management</h6>
        </div>
        <div class="shadow-sm navigation-item" data-link="./?c=proof-verification">
            <i  class="bi bi-check-square navigation-item-icon"></i>
            <h6 class="h6">Proof  Verification</h6>
        </div>
        <div class="shadow-sm navigation-item" data-link="./?c=transfer">
            <i class="bi bi-cash-coin  navigation-item-icon"></i>
            <h6 class="h6">Transfer Request</h6>
        </div>
        <div class="shadow-sm navigation-item" data-link="./?c=upgrade-requests">
            <i class="bi bi-chevron-double-up  navigation-item-icon"></i>
            <h6 class="h6">Upgrade Request </h6>
        </div>
        <div class="shadow-sm navigation-item" data-link="./?c=system-configuration">
            <i  class="bi bi-sliders navigation-item-icon" ></i>
            <h6 class="h6">System Configuration</h6>
        </div>
        <div class="shadow-sm navigation-item" data-link="./?c=system-data">
            <i  class="bi bi-activity navigation-item-icon"></i>
            <h6 class="h6">System Data</h6>
        </div>
      </section>
</section>
<script>
    const navigationItems = document.querySelectorAll(".navigation-item");

    Array.from(navigationItems).forEach(navigationItem => {
        navigationItem.addEventListener("click", () => {

            location.href = !navigationItem.getAttribute("data-link") ? "./" : navigationItem.getAttribute("data-link");
        })
       
    })
</script>