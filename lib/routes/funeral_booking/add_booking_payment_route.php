<?php
require_once("../../functions/bookingController.php");

$payment_method = $_POST['payment_method'] ?? '';

$service_cost = $_POST['service_cost'] ?? 0;
$memorial_cost = $_POST['memorial_cost'] ?? 0;

$total_payment = $_POST['total_payment'] ?? 0;
$paid_amount = $_POST['paid_amount'] ?? 0;

if(empty($payment_method) || empty($total_payment)) {
    echo "Payment details are missing.";
    exit();
}

$paymentinfo = new BookingController();

$payment_code = $paymentinfo->generatePaymentCode();

$transaction_reference = $paymentinfo->generateTransactionReference();

$payment_status = "Paid";

$_POST['payment_code'] = $payment_code;
$_POST['transaction_reference'] = $transaction_reference;
$_POST['payment_status'] = $payment_status;

$paymentinfo->savePaymentInformation($_POST);

$_SESSION['booking']['payment'] = [
    'payment_code' => $payment_code,
    'payment_method' => $payment_method,
    'payment_status' => $payment_status,
    'transaction_reference' => $transaction_reference,
    'service_cost' => $service_cost,
    'memorial_cost' => $memorial_cost,
    'total_payment' => $total_payment,
    'paid_amount' => $paid_amount,
    'payment_date' => date("Y-m-d H:i:s")
];

echo "success";

?>