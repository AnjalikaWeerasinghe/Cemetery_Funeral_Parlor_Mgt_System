<?php
require_once "../../functions/bookingController.php";

$booking = new BookingController();

$data = $booking->getBookingDashboardStats();

echo json_encode($data);

?>