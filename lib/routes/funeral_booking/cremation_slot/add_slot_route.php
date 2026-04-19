<?php

require_once("../../../functions/cremationTimeSlotController.php");

$controller = new CremationTimeSlotController();

echo $controller->addSlot(
    $_POST['day'],
    $_POST['start_time'],
    $_POST['end_time']
);

?>