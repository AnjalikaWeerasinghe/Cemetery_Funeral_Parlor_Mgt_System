<?php
require_once "../../functions/bookingController.php";

if(!isset($_GET['funeral_service_id'])){
    echo "Invalid Booking ID";
    exit;
}

$funeral_service_id = $_GET['funeral_service_id'];

$controller = new BookingController();

$data = $controller->viewBookingDetails($funeral_service_id);

if(!$data){
    echo "Booking details not found";
    exit;
}
?>

<style>
    .booking-card{
        background:white;
        border-radius:18px;
        padding:25px;
        margin-bottom:20px;
        box-shadow:0 8px 25px rgba(0,0,0,.08);
    }

    .booking-title{
        background:linear-gradient(135deg,#8b6f47,#d4af7a);
        color:white;
        padding:20px;
        border-radius:15px;
    }

    .section-title{
        color:#8b6f47;
        font-weight:700;
        border-bottom:2px solid #d4af7a;
        padding-bottom:8px;
        margin-bottom:15px;
    }

    .info-row{
        display:flex;
        justify-content:space-between;
        padding:8px 0;
        border-bottom:1px solid #eee;
    }

    .label{
        font-weight:600;
        color:#555;
    }

    .value{
        color:#222;
    }

    .badge-status{
        background:#d4af7a;
        padding:6px 15px;
        border-radius:20px;
        color:white;
    }
</style>

<div class="container-fluid">

    <div class="booking-card">

        <div class="booking-title">
            <h3>
                <i class="fa-solid fa-calendar-check"></i>Booking Details
            </h3>

            <h5>
                <?= $data['booking_code'] ?>
            </h5>

            <span class="badge-status">
                <?= $data['booking_status'] ?>
            </span>
        </div>

    </div>

    <div class="booking-card">
        <h5 class="section-title">
            <i class="fa-solid fa-user"></i>Deceased Information
        </h5>

        <div class="info-row">
            <span class="label">Name</span>
            <span class="value"><?= $data['full_name'] ?></span>
        </div>

        <div class="info-row">
            <span class="label">NIC</span>
            <span class="value"><?= $data['nic'] ?></span>
        </div>

        <div class="info-row">
            <span class="label">Gender</span>
            <span class="value"><?= $data['gender'] ?></span>
        </div>

        <div class="info-row">
            <span class="label">Religion</span>
            <span class="value"><?= $data['religion'] ?></span>
        </div>

        <div class="info-row">
            <span class="label">Address</span>
            <span class="value"><?= $data['deceased_address'] ?></span>
        </div>
    </div>

    <div class="booking-card">
        <h5 class="section-title">
            <i class="fa-solid fa-users"></i>Applicant Information
        </h5>

        <div class="info-row">
            <span class="label">Applicant Name</span>
            <span class="value"><?= $data['applicant_name'] ?></span>
        </div>

        <div class="info-row">
            <span class="label">Relationship</span>
            <span class="value"><?= $data['relationship_to_deceased'] ?></span>
        </div>

        <div class="info-row">
            <span class="label">Contact</span>
            <span class="value"><?= $data['contact_number'] ?></span>
        </div>

        <div class="info-row">
            <span class="label">Email</span>
            <span class="value"><?= $data['email'] ?></span>
        </div>
    </div>

    <div class="booking-card">
        <h5 class="section-title">
            <i class="fa-solid fa-cross"></i>Service Information
        </h5>

        <div class="info-row">
            <span class="label">Service Type</span>
            <span class="value"><?= $data['service_type'] ?></span>
        </div>

        <div class="info-row">
            <span class="label">Created Date</span>
            <span class="value"><?= $data['booking_created_at'] ?></span>
        </div>
    </div>

    <?php if($data['service_type']=="Burial"){ ?>

        <div class="booking-card">
            <h5 class="section-title">
                <i class="fa-solid fa-cross"></i>Burial Information
            </h5>

            <div class="info-row">
                <span class="label">Burial Date</span>
                <span class="value"><?= $data['burial_date'] ?></span>
            </div>

            <div class="info-row">
                <span class="label">Section</span>
                <span class="value"><?= $data['section_name'] ?? "Not Allocated" ?></span>
            </div>

            <div class="info-row">
                <span class="label">Plot Number</span>
                <span class="value"><?= $data['plot_number'] ?? "Not Allocated" ?></span>
            </div>

            <div class="info-row">
                <span class="label">Location</span>
                <span class="value"><?= $data['row_number'] ?? "-" ?>| <?= $data['block_number'] ?? "-" ?></span>
            </div>
        </div>

    <?php } ?>

    <?php if($data['service_type']=="Cremation"){ ?>

        <div class="booking-card">
            <h5 class="section-title">
                <i class="fa-solid fa-fire"></i>Cremation Information
            </h5>

            <div class="info-row">
                <span class="label">Cremation Date</span>
                <span class="value"><?= $data['cremation_date'] ?></span>
            </div>

            <div class="info-row">
                <span class="label">Area Type</span>
                <span class="value"><?= $data['area_type'] ?></span>
            </div>

            <div class="info-row">
                <span class="label">Ash Collection</span>
                <span class="value"><?= $data['collect_ash'] ? "Yes":"No" ?></span>
            </div>
        </div>

    <?php } ?>

    <div class="booking-card">
        <h5 class="section-title">
            <i class="fa-solid fa-credit-card"></i>Payment Information
        </h5>

        <div class="info-row">
            <span class="label">Payment Code</span>
            <span class="value"><?= $data['payment_code'] ?></span> 
        </div>

        <div class="info-row">
            <span class="label">Amount</span>
            <span class="value">Rs. <?= number_format($data['total_payment'],2) ?></span>
        </div>

        <div class="info-row">
            <span class="label">Payment Status</span>
            <span class="value"><?= $data['payment_status'] ?></span>
        </div>
    </div>

</div>