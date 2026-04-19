<?php
require_once("../../../functions/cremationTimeSlotController.php");

$controller = new CremationTimeSlotController();

echo $controller->deleteSlot($_POST['id']);

?>