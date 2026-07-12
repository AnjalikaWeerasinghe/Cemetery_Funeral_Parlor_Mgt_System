<?php
require_once("../../functions/bookingController.php");

header('Content-Type: application/json');

if(isset($_POST['funeral_service_id'])){

    $funeral_service_id = $_POST['funeral_service_id'];

    $booking = new BookingController();

    $result = $booking->approveBooking($funeral_service_id);

    if($result){
        echo json_encode([
            "booking_status"=>"success",
            "message"=>"Booking confirmed successfully"
        ]);
    }else{
        echo json_encode([
            "booking_status"=>"error",
            "message"=>"Failed to confirm booking"
        ]);
    }
    
    exit;

}

?>