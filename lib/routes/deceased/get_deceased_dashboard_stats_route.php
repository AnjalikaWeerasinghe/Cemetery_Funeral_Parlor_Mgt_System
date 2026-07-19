<?php 
require_once("../../functions/deceasedController.php");

$controller = new DeceasedController();

echo json_encode($controller->getDeceasedDashboardStats());

?>