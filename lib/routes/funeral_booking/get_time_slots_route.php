<?php

require_once("../../functions/bookingController.php");

$bookingController = new BookingController();

$date = $_POST['date'] ?? null;

if(!$date) {
    echo "Select a date.";
    exit();
}

$slots = $bookingController->getSlotsByDay($date);

if(empty($slots) || $slots->num_rows == 0) {
    echo "No time slots available for this day.";
    exit();
}

foreach($slots as $row){

    $time = date("g A", strtotime($row['start_time'])) . " - " .
            date("g A", strtotime($row['end_time']));

    $isDisabled = !$row['is_active'];

    $bgClass = $isDisabled ? "bg-secondary text-white" : "bg-light";

    echo "
    <div class='slot-card border rounded p-2 text-center $bgClass'
         data-id='{$row['slot_id']}'
         style='cursor:pointer; min-width:120px;'>

        $time
    </div>
    ";

}

?>