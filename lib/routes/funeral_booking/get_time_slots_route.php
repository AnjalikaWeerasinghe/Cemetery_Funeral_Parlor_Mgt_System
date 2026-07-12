<?php

require_once("../../functions/bookingController.php");

$bookingController = new BookingController();

// Show available time slots for cremation
$date = $_POST['date'] ?? null;

if(!$date) {
    echo "Select a date.";
    exit();
}
$slots = $bookingController->getSlotsByDate($date);

if(empty($slots)) {
    echo "No time slots available for this day.";
    exit();
}
foreach($slots as $row){
    $time = date("g A", strtotime($row['start_time'])) . " - " .
            date("g A", strtotime($row['end_time']));
    // $isBooked = !empty($row['slot_id']);
    $isBooked = ($row['is_booked'] == 1);
    $isDisabled = !$row['is_active'] || $isBooked;
    $slotType = $row['slot_type'];
    $typeClass = ($slotType === "afterNormal") ? "slot-after" : "slot-normal";
    $disabledClass = $isDisabled ? "slot-disabled" : "";
    echo "
    <div class='col-md-3 mb-3'>
        <div class='slot-card border rounded p-3 text-center $typeClass $disabledClass'
            data-id='{$row['slot_id']}'
            data-text='$time'
            style='cursor:pointer; min-width:120px;'>
            ".($isBooked 
                ? "<span class='badge bg-danger mt-2 mb-3'>Already Booked</span>"
                : "<span class='badge bg-success mt-2 mb-3'>Available</span>"
            )."

            <div class='slot-time font-weight-bold mb-3'>$time</div>
            <small class='text-muted'>".ucfirst($slotType)."</small>
        </div>
    </div>
    ";

}

?>