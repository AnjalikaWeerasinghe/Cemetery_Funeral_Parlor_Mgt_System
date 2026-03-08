<?php
require_once("../../functions/bookingController.php");

$service_type = $_POST['service_type'];

$booking = new BookingController();

echo $booking->getNewBookingCode($service_type);
?>