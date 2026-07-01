<style>
    :root {
        --gold-main:#b58b2a;
        --gold-light:#d4af37;
        --text-dark:#2c2c2c;
        --border-soft:#e5e7eb;
        --bg-soft:#f5f7fb;
    }

    html{
        scroll-behavior:smooth;
    }

    body {
        background:var(--bg-soft);
        font-family: 'Segoe UI', sans-serif;
    }

    .booking-wrapper{
        width: 100%;
        max-width: 1200px;
        margin: auto;
        padding: 0 15px;
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

    .booking-card{
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .booking-card:hover{
        transform: translateY(-3px);
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

    .steps{
        display:flex;
        align-items:center;
        justify-content:flex-start;
        gap:10px;
        overflow-x:auto;
        overflow-y:hidden;
        white-space:nowrap;
        position:sticky;
        top:80px;
        z-index:100;
        background:#fff;
        padding:15px 10px;
        border-radius:15px;
        box-shadow:0 8px 25px rgba(0,0,0,0.05);
        margin-bottom:20px;
        scrollbar-width:thin;
        width: 100%;
    }

    .steps::-webkit-scrollbar {
        height:5px;
    }

    .steps::-webkit-scrollbar-thumb {
        background:var(--gold-main);
        border-radius:10px;
    }

    .step-btn{
        border-radius: 14px;
        padding: 14px 18px;
        font-size: 13px;
        font-weight: 600;
        border: 1px solid var(--border-soft);
        background: #fafafa;
        color: #666;
        transition: all .3s ease;
        white-space: nowrap;
        min-width: 170px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        flex-shrink:0;
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

    #bookingContent{
        min-height: 450px;
        padding-top: 20px;
        animation: fadeIn .35s ease;
    }

    #messageModal .modal-content {
        border-radius: 18px;
        overflow: hidden;
        background: linear-gradient(145deg, #ffffff, #f8f9fc);
        box-shadow:
            0 20px 45px rgba(0,0,0,0.18),
            0 5px 15px rgba(0,0,0,0.08);
        border: 1px solid rgba(201,164,76,0.18);
        animation: modalFade 0.12s ease-out;
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
    }

    .step-btn.active{
        position: relative;
        overflow: hidden;
    }

    .step-btn.active::before{
        content:"";
        position:absolute;
        top:0;
        left:-100%;
        width:100%;
        height:100%;
        background:rgba(255,255,255,0.25);
        transform:skewX(-25deg);
        animation:shine 2s infinite;
    }

    @keyframes shine{
        100%{
            left:120%;
        }
    }

    @keyframes modalFade {
        from{
            opacity: 0;
            transform: translateY(8px);
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

        .booking-card{
            padding:18px;
            border-radius:14px;
        }

        .steps{
            justify-content:flex-start;
            flex-wrap:nowrap;
            overflow-x:auto;
            overflow-y:hidden;
            padding-bottom:12px;
            -webkit-overflow-scrolling:touch;
        }

        .step-btn{
            min-width:160px;
            font-size:12px;
            padding:12px 14px;
        }

        .step-divider{
            display:none;
        }

        h3{
            font-size:22px;
        }

        #bookingContent{
            min-height:300px;
        }
    }

    @media(max-width:576px){

        #messageModal .modal-dialog{
            margin: 15px;
        }

        #messageModal .modal-body{
            padding: 22px 18px;
        }

    }

</style>

<?php
    $isAdmin = (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin');
?>

<div class="booking-wrapper mt-4">
    <div class="booking-card">

        <h3 class="text-center mb-4">Burial Reservation</h3>

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
                Burial Information
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

    window.mode = "create";
    window.bookingCode = "<?= $bookingCode ?? '' ?>";

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
            3: baseRoute + "funeral_booking/burial_information.php",
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