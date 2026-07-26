<?php
require_once("../../functions/paymentController.php");

$member_id = $_SESSION['user_id'];

$paymentController = new PaymentController();

echo $paymentController->loadMyPayments($member_id);

?>