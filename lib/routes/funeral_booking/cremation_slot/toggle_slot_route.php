<?php
require_once("../../../functions/cremationTimeSlotController.php");

$controller = new CremationTimeSlotController();

echo $controller->toggleSlot($_POST['id']);

?>