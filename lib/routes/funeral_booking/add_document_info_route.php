<?php
require_once("../../functions/bookingController.php");

$death_certificate_number = $_POST['death_certificate_number'] ?? '';
$registrar_name = $_POST['registrar_name'] ?? '';
$date_of_death = $_POST['date_of_death'] ?? '';
$cause_of_death = $_POST['cause_of_death'] ?? '';
$death_certificate = $_POST['death_certificate'] ?? '';
$coroner_name = $_POST['coroner_name'] ?? '';
$coroner_decision = $_POST['coroner_decision'] ?? '';
$coroner_certificate = $_POST['coroner_certificate'] ?? '';
$cremation_permission = $_POST[''] ?? '';
$family_consent_letter = $_POST['family_consent_letter'] ?? '';

if (empty($death_certificate_number) || empty($registrar_name) || empty($date_of_death) || empty($cause_of_death) || empty($death_certificate) || 
    empty($cremation_permission) || empty(family_consent_letter)) {

    echo "Please fill the required fields.";
    exit();
}

$documentinfo = new BookingController();

$documentinfo->saveDocumentInformation($_POST);

$_SESSION['booking'] = [
    "death_certificate_number" => $death_certificate_number,
    "registrar_name" => $registrar_name,
    "date_of_death" => $date_of_death,
    "cause_of_death" => $cause_of_death,
    "death_certificate" => $death_certificate,
    "coroner_name" => $coroner_name,
    "coroner_decision" => $coroner_decision,
    "coroner_certificate" => $coroner_certificate,
    "" => $cremation_permission,
    "family_consent_letter" => $family_consent_letter
];

echo "success";
?>