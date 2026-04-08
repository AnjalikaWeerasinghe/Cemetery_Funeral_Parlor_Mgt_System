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

    public function saveDeceasedInformation($data) {

        $full_name = $data['full_name'] ?? '';
        $nic = $data['nic'] ?? '';
        $applicant_name = $data['applicant_name'] ?? '';
        $relationship_to_deceased = $data['relationship_to_deceased'] ?? '';
        $contact_number = $data['contact_number'] ?? '';
        $applicant_address = $data['applicant_address'] ?? '';

        if (empty($full_name) || empty($nic) || empty($applicant_name) || empty($relationship_to_deceased) || empty($contact_number) || 
        empty($applicant_address)) {

            echo "Please fill the required fields.";
            exit();
        }

        $_SESSION['booking']['step1'] = $data;

        return "success";
    }

    public function saveDocumentInformation($data) {

        $death_certificate_number = $data['death_certificate_number'] ?? '';
        $registrar_name = $data['registrar_name'] ?? '';
        $date_of_death = $data['date_of_death'] ?? '';
        $cause_of_death = $data['cause_of_death'] ?? '';
        $death_certificate = $data['death_certificate'] ?? '';
        $cremation_permission = $data[''] ?? '';
        $family_consent_letter = $data['family_consent_letter'] ?? '';

        if (empty($death_certificate_number) || empty($registrar_name) || empty($date_of_death) || empty($cause_of_death) || empty($death_certificate) || 
            empty($cremation_permission) || empty(family_consent_letter)) {

            echo "Please fill the required fields.";
            exit();
        }

        $_SESSION['booking']['step2'] = $data;

        return "success";
    }

}

?>