<?php 
require_once("../../functions/empController.php");

$controller = new EmpController();

echo json_encode($controller->getStaffMemberDashboardStats());

?>