<?php
require_once "../../functions/bookingController.php";

header("Content-Type: application/json");

$controller = new BookingController();

if (!isset($_GET['booking_code'])) {
    echo json_encode(["error" => "Booking Code required"]);
    exit;
}

$bookingCode = $_GET['booking_code'] ?? null;

$data = $controller->getFuneralBookingDetails_By_BookingCode($bookingCode);

echo json_encode($data);

?>