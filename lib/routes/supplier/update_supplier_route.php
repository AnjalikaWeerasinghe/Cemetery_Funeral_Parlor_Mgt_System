<?php
include_once("../../functions/supplierController.php");

$supplier = new SupplierController();

$data = $_POST;

$result = $supplier->updateSupplier($data);

echo $result;

?>