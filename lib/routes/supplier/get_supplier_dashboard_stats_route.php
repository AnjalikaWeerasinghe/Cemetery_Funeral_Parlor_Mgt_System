<?php 
require_once("../../functions/supplierController.php");

$controller = new SupplierController();

echo json_encode($controller->getSupplierDashboardStats());

?>