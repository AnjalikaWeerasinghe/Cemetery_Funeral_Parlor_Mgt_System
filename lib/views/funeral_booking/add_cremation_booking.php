<style>

.guest-view {
    margin-top: 110px;
}

.admin-view {
    margin-top: 0;
}

</style>

<?php
$isAdmin = (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin');
?>

<div class="back-container <?php echo $isAdmin ? 'admin-view' : 'guest-view'; ?>">
    <a href="" id="backBtn" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Go Back to Funeral Bookings">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
</div>

<div class="container mt-4">

    <div class="steps text-center mb-4">

        <button class="btn btn-primary step-btn" data-step="1">
            Deceased Information
        </button>
        <span>→</span>

        <button class="btn btn-secondary step-btn" data-step="2">
            Document Information
        </button>
        <span>→</span>

        <button class="btn btn-secondary step-btn" data-step="3">
            Cremation Information
        </button>

    </div>

    <div id="bookingContent">

    </div>

</div>

<script>
    $(document).ready(function(){

        loadStep(1);

        const basePage = "<?php echo ($isAdmin) ? 'admin.php' : 'index.php'; ?>";
         document.getElementById("backBtn").href = basePage + "?page=selectbookingtype";

    });

    const baseRoute = "<?php echo (strpos($_SERVER['PHP_SELF'], 'admin.php') !== false) 
        ? '../views/' 
        : 'lib/views/'; ?>";

    function loadStep(step){

        const routes = {
            1: baseRoute + "funeral_booking/deceased_information.php",
            2: baseRoute + "funeral_booking/document_information.php",
            3: baseRoute + "funeral_booking/cremation_information.php"
        };

        $("#bookingContent").load(routes[step]);
    }

    $(document).on("click",".step-btn",function(){

        let step = $(this).data("step");

        loadStep(step);

    });

    const basePage = "<?php echo (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') ? 'admin.php' : 'index.php'; ?>";

</script>