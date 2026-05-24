<?php
include_once('../../functions/bookingController.php');

$bookingViewObj = new BookingController();
$result = $bookingViewObj->view_Booking_Data();
echo($result);

?>