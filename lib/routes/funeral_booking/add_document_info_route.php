<?php
require_once("../../functions/bookingController.php");

$death_certificate_number = $_POST['death_certificate_number'] ?? '';
$registrar_name = $_POST['registrar_name'] ?? '';
$date_of_death = $_POST['date_of_death'] ?? '';
$cause_of_death = $_POST['cause_of_death'] ?? '';

$death_certificate = $_FILES['death_certificate'] ?? null;

$coroner_name = $_POST['coroner_name'] ?? '';
$coroner_decision = $_POST['coroner_decision'] ?? '';

$coroner_certificate = $_FILES['coroner_certificate'] ?? null;

$cremation_permission = $_POST['cremation_permission'] ?? '';

$family_consent_letter = $_FILES['family_consent_letter'] ?? null;

if (empty($death_certificate_number) || empty($registrar_name) || empty($date_of_death) || empty($cause_of_death) || empty($cremation_permission)) {

    echo "Please fill the required fields.";
    exit();
}

if ($death_certificate['error'] !== 0 && $family_consent_letter['error'] !== 0) {
    echo "Please uploads the relevant documents.";
    exit();
}

$documentinfo = new BookingController();
$documentinfo->saveDocumentInformation($_POST, $_FILES);

$_SESSION['booking']['step2'] = [
    "death_certificate_number" => $death_certificate_number,
    "registrar_name" => $registrar_name,
    "date_of_death" => $date_of_death,
    "cause_of_death" => $cause_of_death,
    "coroner_name" => $coroner_name,
    "coroner_decision" => $coroner_decision,
    "cremation_permission" => $cremation_permission
];

echo "success";
?>