<?php 
require_once("../../functions/bookingController.php");

$booking = new BookingController();

$result = $booking->confirmBurialBooking();

if(is_array($result) && $result['status'] == "success"){

    echo "success";

} else {

    echo $result;
    
}

?>