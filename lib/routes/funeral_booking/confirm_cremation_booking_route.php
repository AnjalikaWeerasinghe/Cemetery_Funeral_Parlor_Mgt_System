<?php 
require_once("../../functions/bookingController.php");

$booking = new BookingController();

$result = $booking->confirmCremationBooking();

echo json_encode($result);

?>