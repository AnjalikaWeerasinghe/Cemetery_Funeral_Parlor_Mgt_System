<?php
$bookingCode = $_GET['booking_code'] ?? null;
?>

<div class="booking-wrapper mt-4">
    <div class="booking-card">

        <h3 class="text-center mb-4">Crematorium Reservation Details</h3>

        <div class="steps">

            <button class="btn step-btn active" data-step="1">
                Deceased Information
            </button>

            <span class="step-divider">
                <i class="fa-solid fa-chevron-right"></i>
            </span>

            <button class="btn step-btn" data-step="2">
                Document Information
            </button>

            <span class="step-divider">
                <i class="fa-solid fa-chevron-right"></i>
            </span>

            <button class="btn step-btn" data-step="3">
                Cremation Information
            </button>

        </div>

        <div id="bookingContent"></div>

    </div>
</div>

<script>
    const baseRoute = "<?php echo (strpos($_SERVER['PHP_SELF'], 'admin.php') !== false) 
        ? '../views/' 
        : 'lib/views/'; ?>";

    window.bookingCode = "<?= $bookingCode ?>";
    window.mode = "view";

    $(document).ready(function () {

        loadStep(1);

    });

    function loadStep(step){

        const routes = {
            1: baseRoute + "funeral_booking/deceased_information.php",
            2: baseRoute + "funeral_booking/document_information.php",
            3: baseRoute + "funeral_booking/cremation_information.php"
        };

        $("#bookingContent").load(routes[step] + "?booking_code=" + window.bookingCode);

        setActiveStep(step);
    }

    $(document).on("click", ".step-btn", function(){

        let step = $(this).data("step");

        loadStep(step);

    });

    function setActiveStep(step){

        $(".step-btn").removeClass("active");

        $(`.step-btn[data-step='${step}']`)
            .addClass("active");
    }

</script>