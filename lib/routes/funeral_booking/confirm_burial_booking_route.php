<?php 
require_once("../../functions/bookingController.php");

$booking = new BookingController();

$result = $booking->confirmBurialBooking();

echo json_encode($result);

?>