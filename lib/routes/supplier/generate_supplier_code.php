<?php
require_once("../../functions/supplierController.php");

$supplier = new SupplierController();

echo $supplier->getNewSupplierCode();
?>