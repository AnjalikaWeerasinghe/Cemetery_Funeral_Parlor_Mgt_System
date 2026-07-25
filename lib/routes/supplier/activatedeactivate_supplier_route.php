<?php
include_once('../../functions/supplierController.php');

$supplier = new SupplierController();

$result = $supplier->activateDeactivateSupplier($_POST['id'], $_POST['status']);

echo($result);

?>