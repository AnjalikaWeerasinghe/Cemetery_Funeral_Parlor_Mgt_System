<?php
include_once("../../functions/supplierController.php");

header('Content-Type: application/json');

$supplier = new SupplierController();

$supplier_id = $_GET['supplier_id'] ?? null;

if ($supplier_id) {
    $result = $supplier->getSupplierById((int)$supplier_id);
    echo json_encode($result);
} else {
    echo json_encode(["error" => "Supplier ID missing"]);
}

?>