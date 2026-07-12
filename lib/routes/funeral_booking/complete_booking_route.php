<?php
include_once("../../functions/BookingController.php");

if(isset($_POST['funeral_service_id'])){

    $controller = new BookingController();

    if($controller->completeBooking($_POST['funeral_service_id'])){
        echo "success";
    }else{
        echo "error";
    }
}

?>