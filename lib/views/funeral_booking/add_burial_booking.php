<style>
body {
    background: #f5f7fb;
    font-family: 'Segoe UI', sans-serif;
}

.container {
    max-width: 1100px;
}

.back-container {
    position: absolute;
    left: 20px;
}

.guest-view { margin-top: 180px; padding-top: 200px;}
.admin-view { margin-top: 20px; }

.booking-card {
    background: #fff;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

h3 {
    color: #222;
    font-weight: 600;
}

h3::after {
    content: "";
    display: block;
    width: 50px;
    height: 3px;
    background: #c9a44c;
    margin: 8px auto 0;
    border-radius: 2px;
}

.steps {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.step-btn {
    border-radius: 50px;
    padding: 10px 18px;
    font-size: 13px;
    border: 1px solid #ddd;
    background: #f8f9fa;
    color: #555;
    transition: all 0.3s ease;
}

.step-btn.active {
    background: linear-gradient(135deg, #c9a44c, #f4d03f);
    color: #000;
    border: none;
    box-shadow: 0 4px 12px rgba(201,164,76,0.3);
}

.step-btn.completed {
    background: #fff;
    color: #c9a44c;
    border: 1px solid #c9a44c;
}

.step-btn:hover {
    border-color: #c9a44c;
    color: #c9a44c;
}

.steps span {
    color: #ccc;
}

#bookingContent {
    min-height: 300px;
    padding-top: 10px;
}

#bookingContent {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

</style>

<?php
    $isAdmin = (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin');
?>

<div class="container mt-4">
    <div class="booking-card">

        <h3 class="text-center mb-4">Burial Reservation</h3>

        <div class="steps text-center mb-4">

            <button class="btn step-btn" data-step="1">
                Deceased Information
            </button>
            <span>→</span>

            <button class="btn step-btn" data-step="2">
                Document Information
            </button>
            <span>→</span>

            <button class="btn step-btn" data-step="3">
                Burial Information
            </button>
            <span>→</span>

            <button class="btn step-btn" data-step="4">
                Confirm the Reservation
            </button>
            <span>→</span>

            <button class="btn step-btn" data-step="5">
                Payment Information
            </button>

        </div>

        <div id="bookingContent">

        </div>
    </div>

</div>

<script>
    $(document).ready(function(){

        loadStep(1);

        const basePage = "<?php echo ($isAdmin) ? 'admin.php' : 'index.php'; ?>";
        //  document.getElementById("backBtn").href = basePage + "?page=selectbookingtype";

    });

    const baseRoute = "<?php echo (strpos($_SERVER['PHP_SELF'], 'admin.php') !== false) 
        ? '../views/' 
        : 'lib/views/'; ?>";

    function setActiveStep(step) {

        $(".step-btn").removeClass("active completed");

        $(".step-btn").each(function () {
            let btnStep = $(this).data("step");

            if (btnStep < step) {
                $(this).addClass("completed");
            } else if (btnStep == step) {
                $(this).addClass("active");
            }
        });
    }

    function loadStep(step){

        const routes = {
            1: baseRoute + "funeral_booking/deceased_information.php",
            2: baseRoute + "funeral_booking/document_information.php",
            3: baseRoute + "funeral_booking/burial_information.php",
            4: baseRoute + "funeral_booking/confirmation.php",
            5: baseRoute + "funeral_booking/booking_payment.php"
        };

        $("#bookingContent").load(routes[step]);

        setActiveStep(step);
    }

    $(document).on("click",".step-btn",function(){

        let step = $(this).data("step");

        loadStep(step);

    });

    const basePage = "<?php echo (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') ? 'admin.php' : 'index.php'; ?>";

</script>