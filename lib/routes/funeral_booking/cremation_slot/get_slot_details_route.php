<?php

require_once("../../../functions/cremationTimeSlotController.php");

$controller = new CremationTimeSlotController();

$slotId = $_POST['slot_id'];

echo $controller->getSlotBookingDetails($slotId);

?>