<?php
require_once("../../functions/bookingController.php");
require_once("../../functions/fileUpload.php");

$death_certificate_number = $_POST['death_certificate_number'] ?? '';
$registrar_name = $_POST['registrar_name'] ?? '';
$date_of_death = $_POST['date_of_death'] ?? '';
$cause_of_death = $_POST['cause_of_death'] ?? '';

$death_certificate = $_FILES['death_certificate'] ?? [];

$coroner_name = $_POST['coroner_name'] ?? '';
$coroner_decision = $_POST['coroner_decision'] ?? '';

$coroner_certificate = $_FILES['coroner_certificate'] ?? [];

$cremation_permission = $_POST['cremation_permission'] ?? '';

$family_consent_letter = $_FILES['family_consent_letter'] ?? [];

if (
    empty($death_certificate_number) || empty($registrar_name) || empty($date_of_death) || empty($cause_of_death) || $cremation_permission === ''
) {
    echo "Please fill the required fields.";
    exit();
}

$existingDeathCertificate = $_SESSION['booking']['step2']['death_certificate'] ?? null;
$existingFamilyConsent = $_SESSION['booking']['step2']['family_consent_letter'] ?? null;

$deathUploaded = isset($death_certificate['error']) && $death_certificate['error'] === 0;
$familyUploaded = isset($family_consent_letter['error']) && $family_consent_letter['error'] === 0;

if(!$deathUploaded && empty($existingDeathCertificate)){
    echo "Please upload the death certificate.";
    exit();
}

if(!$familyUploaded && empty($existingFamilyConsent)){
    echo "Please upload the family consent letter.";
    exit();
}

if($deathUploaded){

    $deathFileName = FileUpload::upload($death_certificate, 'death_certificates', ['jpg', 'jpeg', 'png', 'pdf']);

    if (!$deathFileName) {
        echo "Failed to upload death certificate.";
        exit();
    }

} else {
    $deathFileName = $_SESSION['booking']['step2']['death_certificate'] ?? '';
}

if($familyUploaded){

    $familyFileName = FileUpload::upload($family_consent_letter, 'family_consent_letters', ['jpg', 'jpeg', 'png', 'pdf']);

    if (!$familyFileName) {
        echo "Failed to upload family consent letter.";
        exit();
    }

} else {

    $familyFileName = $_SESSION['booking']['step2']['family_consent_letter'] ?? '';
}

$coronerFileName = $_SESSION['booking']['step2']['coroner_certificate'] ?? '';;

if (isset($coroner_certificate['error']) && $coroner_certificate['error'] === 0) {

    $coronerFileName = FileUpload::upload($coroner_certificate, 'coroner_certificates', ['jpg', 'jpeg', 'png', 'pdf']);

    if (!$coronerFileName) {
        echo "Failed to upload coroner certificate.";
        exit();
    }
}

$verification_status = "Pending";

$_POST['death_certificate'] = $deathFileName;
$_POST['family_consent_letter'] = $familyFileName;
$_POST['coroner_certificate'] = $coronerFileName;

$documentinfo = new BookingController();
$documentinfo->saveDocumentInformation($_POST, $_FILES);

$_SESSION['booking']['step2'] = [
    "death_certificate_number" => $death_certificate_number,
    "registrar_name" => $registrar_name,
    "date_of_death" => $date_of_death,
    "cause_of_death" => $cause_of_death,
    "coroner_name" => $coroner_name,
    "coroner_decision" => $coroner_decision,
    "cremation_permission" => $cremation_permission,
    "verification_status" => $verification_status,

    "death_certificate" => $deathFileName,
    "coroner_certificate" => $coronerFileName,
    "family_consent_letter" => $familyFileName
];

echo json_encode([
    "status" => "success",
    "death_certificate_path" => $deathFileName,
    "family_consent_letter_path" => $familyFileName,
    "coroner_certificate_path" => $coronerFileName
]);

exit();

?>