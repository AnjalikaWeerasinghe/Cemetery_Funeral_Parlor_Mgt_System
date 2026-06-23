<?php

require_once("../../../functions/cremationTimeSlotController.php");

$controller = new CremationTimeSlotController();

$day = $_POST['day'];

$result = $controller->getSlotsByDay($day);

if($result->num_rows == 0){

    echo '
    <div class="col-12 text-center text-muted py-5">
        <i class="fas fa-clock fa-3x mb-3"></i>
        <p>No time slots available for this day.</p>
    </div>';

    exit;
}

while($row = $result->fetch_assoc()){

    $time = date("g:i A", strtotime($row['start_time'])) .
            " - " .
            date("g:i A", strtotime($row['end_time']));

    $slotClass = "slot-standard";

    if(strtolower($row['slot_type']) == "peak"){
        $slotClass = "slot-peak";
    }
    elseif(strtolower($row['slot_type']) == "premium"){
        $slotClass = "slot-premium";
    }

    $disabledClass = "";

    if(isset($row['is_active']) && $row['is_active'] == 0){
        $disabledClass = "slot-disabled";
    }

    echo '
        <div class="slot-card '.$slotClass.' '.$disabledClass.'"
            data-id="'.$row['slot_id'].'">

            <div class="slot-time">
                '.$time.'
            </div>

            <div class="slot-type mt-2">
                '.ucfirst($row['slot_type']).'
            </div>

            <div class="slot-actions mt-3">

                <button class="btn btn-sm btn-danger me-1"
                        onclick="event.stopPropagation(); deleteSlot('.$row['slot_id'].')">
                    <i class="fa fa-trash"></i>
                </button>

                <button class="btn btn-sm btn-warning"
                        onclick="event.stopPropagation(); toggleSlot('.$row['slot_id'].')">
                    <i class="fa fa-sync"></i>
                </button>

            </div>

        </div>
    ';
}

?>