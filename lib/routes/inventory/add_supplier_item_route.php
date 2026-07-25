<?php
require_once("../../functions/supplierItemController.php");

$supplierItemController = new SupplierItemController();

$response = $supplierItemController->addSupplierItem($_POST);

echo json_encode($response);

?>