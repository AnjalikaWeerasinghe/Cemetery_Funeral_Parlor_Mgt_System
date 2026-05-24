<?php
require_once("../../functions/bookingController.php");

// var_dump($_POST['service_type']);
// exit;

$service_type = $_POST['service_type'] ?? '';

$full_name = $_POST['full_name'] ?? '';
$nic = $_POST['nic'] ?? '';
$gender = $_POST['gender'] ?? '';
$date_of_birth = $_POST['date_of_birth'] ?? '';
$deceased_address = $_POST['deceased_address'] ?? '';
$deceased_gn_division = $_POST['deceased_gn_division'] ?? '';
$municipal_council = $_POST['municipal_council'] ?? '';

$applicant_name = $_POST['applicant_name'] ?? '';
$relationship_to_deceased = $_POST['relationship_to_deceased'] ?? '';
$contact_number = $_POST['contact_number'] ?? '';
$email = $_POST['email'] ?? '';
$applicant_gn_division = $_POST['applicant_gn_division'] ?? '';
$applicant_address = $_POST['applicant_address'] ?? '';

if (empty($full_name) || empty($nic) || empty($applicant_name) || empty($relationship_to_deceased) || empty($contact_number) || 
    empty($applicant_address)) {

    echo "Please fill the required fields.";
    exit();
}

$deceasedinfo = new BookingController();

$deceasedinfo->saveDeceasedInformation($_POST);

$_SESSION['booking']['step1'] = [
    "service_type" => $service_type,

    "full_name" => $full_name,
    "nic" => $nic,
    "gender" => $gender,
    "date_of_birth" => $date_of_birth,
    "deceased_address" => $deceased_address,
    "deceased_gn_division" => $deceased_gn_division,
    "municipal_council" => $municipal_council,
    
    "applicant_name" => $applicant_name,
    "relationship_to_deceased" => $relationship_to_deceased,
    "contact_number" => $contact_number,
    "email" => $email,
    "applicant_gn_division" => $applicant_gn_division,
    "applicant_address" => $applicant_address
];

echo "success";

?>