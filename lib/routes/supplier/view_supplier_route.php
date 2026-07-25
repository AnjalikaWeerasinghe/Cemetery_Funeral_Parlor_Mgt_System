<?php
include_once('../../functions/supplierController.php');

$supplierViewObj = new SupplierController();

$search = $_GET['search'] ?? '';

echo $supplierViewObj->view_Supplier_Data($search);

?>