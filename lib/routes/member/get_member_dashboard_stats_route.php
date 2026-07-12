<?php 
require_once("../../functions/memberController.php");

$controller = new MemberController();

echo json_encode($controller->getMemberDashboardStats());

?>