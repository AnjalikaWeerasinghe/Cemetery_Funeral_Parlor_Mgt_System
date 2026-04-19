<?php

require_once("../../../functions/cremationTimeSlotController.php");

$controller = new CremationTimeSlotController();

$day = $_POST['day'];

$result = $controller->getSlotsByDay($day);

while($row = $result->fetch_assoc()){

    $time = date("g A", strtotime($row['start_time'])) . " - " .
            date("g A", strtotime($row['end_time']));

    echo "
    <div class='row'>
        <div class='card shadow-sm mb-2 col-md-6'>
            <div class='card-body d-flex justify-content-between align-items-center'>
                
                <div>
                    <strong>$time</strong><br>
                </div>

                <div>
                    <button class='btn btn-sm btn-danger me-1' onclick='deleteSlot({$row['slot_id']})'>
                        <i class='fa fa-trash'></i>
                    </button>

                    <button class='btn btn-sm btn-warning' onclick='toggleSlot({$row['slot_id']})'>
                        <i class='fa fa-sync'></i>
                    </button>
                </div>

            </div>
        </div>
    </div>
    ";
}

?>