<?php
include_once("../../functions/supplierController.php");

$supplier = new SupplierController();

$supplier->loadSuppliers();

?>