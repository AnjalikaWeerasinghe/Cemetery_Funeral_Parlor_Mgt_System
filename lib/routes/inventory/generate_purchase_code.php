<?php
require_once("../../functions/purchaseController.php");

$purchase = new PurchaseController();

echo $purchase->getNewPurchaseCode();
?>