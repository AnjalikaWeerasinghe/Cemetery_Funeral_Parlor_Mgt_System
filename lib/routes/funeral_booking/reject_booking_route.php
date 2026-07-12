<?php
require_once("../../functions/bookingController.php");

header('Content-Type: application/json');

if(isset($_POST['funeral_service_id'])){

    $funeral_service_id=$_POST['funeral_service_id'];

    $booking = new BookingController();

    $result=$booking->rejectBooking($funeral_service_id);

    if($result){
        echo json_encode([
            "status"=>"success",
            "message"=>"Booking cancelled"
        ]);
    }else{
        echo json_encode([
            "status"=>"error",
            "message"=>"Failed to cancel the booking"
        ]);
    }

}

?>