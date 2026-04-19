<?php

// var_dump($_GET);
// exit;

require_once("../../functions/bookingController.php");

$service_type = $_POST['service_type'] ?? null;

if(!$service_type){
    echo "ERROR: No service type received";
    exit;
}

$booking = new BookingController();

echo $booking->getNewBookingCode($service_type);

?>