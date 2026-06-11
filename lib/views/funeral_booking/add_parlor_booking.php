<style>
:root {
    --gold-main:#b58b2a;
    --gold-light:#d4af37;
    --text-dark:#2c2c2c;
    --border-soft:#e5e7eb;
    --bg-soft:#f5f7fb;
}

body {
    background:var(--bg-soft);
    font-family: 'Segoe UI', sans-serif;
}

.container {
    max-width: 1150px;
}

.back-container {
    position: absolute;
    left: 20px;
}

.guest-view { margin-top: 110px; }
.admin-view { margin-top: 20px; }

.booking-card {
    background:#fff;
    border-radius:18px;
    padding:35px;
    box-shadow:0 15px 40px rgba(0,0,0,0.06);
    border:1px solid rgba(0,0,0,0.03);
}

h3 {
    color:var(--text-dark);
    font-weight:700;
    letter-spacing:.3px;
    position:relative;
}

h3::after {
    content:"";
    width:60px;
    height:4px;
    background:linear-gradient(135deg,var(--gold-main),var(--gold-light));
    display:block;
    margin:12px auto 0;
    border-radius:50px;
}

.steps {
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:10px;
    overflow-x:auto;
    padding-bottom:10px;
    margin-bottom:5px;
}

.steps::-webkit-scrollbar {
    height:5px;
}

.steps::-webkit-scrollbar-thumb {
    background:var(--gold-main);
    border-radius:10px;
}

.step-btn {
    border-radius:50px;
    padding:12px 18px;
    font-size:13px;
    font-weight:600;
    border:1px solid var(--border-soft);
    background:#fafafa;
    color:#666;
    transition:all .3s ease;
    white-space:nowrap;
    min-width:max-content;
}

.step-btn:hover {
    border-color:var(--gold-main);
    color:var(--gold-main);
}

.step-btn.active {
    background:linear-gradient(135deg,var(--gold-main),var(--gold-light));
    color:#fff;
    border:none;
    box-shadow:0 8px 20px rgba(181,139,42,.25);
    transform:translateY(-2px);
}

.step-btn.completed {
    background:#fffdf7;
    color:var(--gold-main);
    border:1px solid rgba(181,139,42,.4);
}

.step-divider {
    color:var(--gold-main);
    font-size:12px;
    flex-shrink:0;
}

#bookingContent {
    min-height:350px;
    animation:fadeIn .3s ease;
}

#messageModal .modal-content {
    border-radius: 18px;
    overflow: hidden;
    background: linear-gradient(145deg, #ffffff, #f8f9fc);
    box-shadow:
        0 20px 45px rgba(0,0,0,0.18),
        0 5px 15px rgba(0,0,0,0.08);
    border: 1px solid rgba(201,164,76,0.18);
    animation: modalFade 0.25s ease;
}

#messageModal .modal-header {
    background: linear-gradient(135deg, #c9a44c, #f1d47a);
    border-bottom: none;
    padding: 18px 24px;
}

#messageModal .modal-title {
    font-weight: 600;
    letter-spacing: 0.5px;
    color: #2b2b2b;
    font-size: 18px;
}

#messageModal .btn-close {
    filter: brightness(0.2);
    opacity: 0.8;
    transition: 0.2s;
}

#messageModal .btn-close:hover {
    transform: rotate(90deg);
    opacity: 1;
}

#messageModal .modal-body {
    padding: 30px 24px;
    text-align: center;
    background: #fff;
}

#modalMessage {
    font-size: 15px;
    color: #444;
    line-height: 1.7;
    font-weight: 500;
}

#messageModal .modal-footer {
    border-top: none;
    justify-content: center;
    padding: 0 24px 24px;
    background: #fff;
}

#messageModal .btn-dark {
    background: linear-gradient(135deg, #2b2b2b, #1a1a1a);
    border: none;
    border-radius: 12px;
    padding: 10px 28px;
    font-weight: 600;
    letter-spacing: 0.4px;
    transition: all 0.3s ease;
    box-shadow: 0 6px 16px rgba(0,0,0,0.18);
}

#messageModal .btn-dark:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 22px rgba(0,0,0,0.22);
    background: linear-gradient(135deg, #1f1f1f, #000);
}

#messageModal .btn-dark:active {
    transform: scale(0.97);
}

.modal-backdrop.show {
    background: rgba(15,15,15,0.75);
    backdrop-filter: blur(4px);
}

@keyframes modalFade {
    from{
        opacity: 0;
        transform: translateY(20px) scale(0.96);
    }
    to{
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@keyframes fadeIn {
    from{
        opacity:0;
        transform:translateY(10px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

@media(max-width:768px) {

    .booking-card{
        padding:20px;
    }

    .step-btn{
        font-size:12px;
        padding:10px 14px;
    }
}

</style>

<?php
    $isAdmin = (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin');
?>

<div class="container mt-4">
    <div class="booking-card">

        <h3 class="text-center mb-4">'Nisala Arana' Parlor Reservation</h3>

        <div class="steps">

            <button class="btn step-btn" data-step="1">
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
                Parlor Information
            </button>
            <span class="step-divider">
                <i class="fa-solid fa-chevron-right"></i>
            </span>

            <button class="btn step-btn" data-step="4">
                Confirmation
            </button>
            <span class="step-divider">
                <i class="fa-solid fa-chevron-right"></i>
            </span>

            <button class="btn step-btn" data-step="5">
                Payment
            </button>

        </div>

        <div id="bookingContent">

        </div>
    </div>

</div>

<div class="modal fade" id="messageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title">
                    System Message
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p id="modalMessage" class="mb-0"></p>
            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-dark px-4"
                        data-bs-dismiss="modal">
                    OK
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    let completedStep = 1;

    const baseRoute = "<?php echo (strpos($_SERVER['PHP_SELF'], 'admin.php') !== false) 
        ? '../views/' 
        : 'lib/views/'; ?>";

    $(document).ready(function(){

        loadStep(1);

    });

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
            3: baseRoute + "funeral_booking/parlor_information.php",
            4: baseRoute + "funeral_booking/confirmation.php",
            5: baseRoute + "funeral_booking/booking_payment.php"
        };

        $("#bookingContent").load(routes[step]);

        setActiveStep(step);
    }

    $(document).on("click",".step-btn",function(){

        let step = $(this).data("step");

        if(step <= completedStep){
            loadStep(step);
        }
        else{
            showMessage("Please complete previous steps first.");
        }


    });

    function unlockStep(step){

        if(step > completedStep){
            completedStep = step;
        }

    }

    function showMessage(message){

        $("#modalMessage").text(message);

        let modal = new bootstrap.Modal(
            document.getElementById("messageModal")
        );

        modal.show();

    }

</script>