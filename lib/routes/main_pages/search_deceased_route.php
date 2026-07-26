<?php
include_once('../../functions/deceasedController.php');

$controller = new DeceasedController();

$keyword = $_POST['keyword'] ?? "";

$result = $controller->searchDeceased($keyword);

if($result->num_rows == 0){
    echo "
    <div class='alert alert-warning mt-4'>
        No deceased records found.
    </div>";

    exit;
}

while($row = $result->fetch_assoc()){

?>
<div class="search-result-card">

    <h5>
        <i class="fa-solid fa-user me-2"></i><?= $row['full_name'] ?>
    </h5>

    <hr>

    <div class="info-row">
        <i class="fa-solid fa-id-card"></i><b>NIC: </b><span><?= $row['nic'] ?></span>
    </div>

    <div class="info-row">
        <i class="fa-solid fa-receipt"></i><b>Booking Code: </b><span><?= $row['booking_code'] ?></span>
    </div>

    <div class="info-row">
        <i class="fa-solid fa-cross"></i><b>Service: </b><span><?= $row['service_type'] ?></span>
    </div>

    <div class="info-row">
        <i class="fa-solid fa-calendar"></i><b>Date of Death: </b><span><?= $row['date_of_death'] ?? 'Not Available' ?></span>
    </div>

    <?php if($row['service_type'] == "Burial"){ ?>

        <hr>

        <h6 class="text-gold">
            <i class="fa-solid fa-location-dot"></i>Burial Information
        </h6>

        <div class="info-row">
            <b>Burial Date: </b><span><?= $row['burial_date'] ?? 'Not Scheduled' ?></span>
        </div>

        <div class="info-row">
            <b>Section: </b><span><?= $row['section_name'] ?? 'Not Allocated' ?></span>
        </div>

        <div class="info-row">
            <b>Plot: </b><span><?= $row['plot_number'] ?? 'Not Allocated' ?></span>
        </div>

        <div class="info-row">
            <b>Location: </b>
            <span>
                <?= $row['row_number'] ?? '-' ?> | <?= $row['block_number'] ?? '-' ?>
            </span>
        </div>

    <?php } else if($row['service_type']=="Cremation"){ ?>

        <hr>

        <h6 class="text-gold">
            <i class="fa-solid fa-fire"></i>Cremation Information
        </h6>

        <div class="info-row">
            <b>Cremation Date: </b>
            <span><?= $row['cremation_date'] ?? 'Not Scheduled' ?></span>
        </div>

        <div class="info-row">
            <b>Ash Collection:</b>
            <span><?= $row['ash_collection_method'] ?? 'No Information' ?></span>
        </div>

    <?php } ?>

    <hr>

    <h6 class="text-gold">
        <i class="fa-solid fa-file-lines"></i>Document Information
    </h6>

    <div class="info-row">
        <b>Death Certificate Number:</b>
        <span>
            <?= $row['death_certificate_number'] ?? 'Not Available' ?>
        </span>
    </div>

    <div class="info-row">
        <b>Cause of Death:</b>
        <span>
            <?= $row['cause_of_death'] ?? 'Not Available' ?>
        </span>
    </div>

</div>

<?php

}


?>