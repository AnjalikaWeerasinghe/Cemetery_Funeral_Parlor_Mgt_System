<?php
session_start();
include_once('main.php');
include_once('numberGeneration.php');

class BookingController extends MainController{

    public function getNewBookingCode($service_type) {
        $number = new Numbering();

        if($service_type == "Cremation"){
            $prefix = "CEM-CRM-";
        } else {
            $prefix = "CEM-BRL-";
        }

        return $number->generateUniqueNumber("booking_code", "funeral_service_table", $prefix);
    }

}

?>