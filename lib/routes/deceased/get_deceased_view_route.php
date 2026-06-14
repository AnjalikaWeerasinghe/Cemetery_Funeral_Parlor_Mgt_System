<?php
include_once(__DIR__ . '/../../functions/deceasedController.php');

if (!isset($_GET['booking_code']) || empty($_GET['booking_code'])) {
    die("Booking code is missing from URL");
}

$booking_code = $_GET['booking_code'] ?? '';

$deceasedView = new DeceasedController();
$deceaseddata = $deceasedView->getDeceasedDetails_By_BookingCode($booking_code);

?>