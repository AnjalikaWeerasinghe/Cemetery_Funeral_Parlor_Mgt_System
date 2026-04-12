<?php
include_once('../../functions/bookingController.php');

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

$booking_service_type = new BookingController();

$data = [
    'service_type' => sanitize_input($_POST['service_type'] ?? '')
];

$result = $booking_service_type->saveServiceType($data);

echo $result;

?>