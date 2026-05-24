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

if (
    empty($death_certificate_number) || empty($registrar_name) || empty($date_of_death) || empty($cause_of_death) || empty($cremation_permission)
) {
    echo "Please fill the required fields.";
    exit();
}

if (
    $death_certificate['error'] !== 0 || $family_consent_letter['error'] !== 0
) {
    echo "Please upload the required documents.";
    exit();
}

$allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];

$deathExt = strtolower(pathinfo($death_certificate['name'], PATHINFO_EXTENSION));

if (!in_array($deathExt, $allowedTypes)) {
    echo "Invalid death certificate file type.";
    exit();
}

if ($death_certificate['size'] > 2 * 1024 * 1024) {
    echo "Death certificate exceeds 2MB.";
    exit();
}

$familyConExt = strtolower(pathinfo($family_consent_letter['name'], PATHINFO_EXTENSION));

if (!in_array($familyConExt, $allowedTypes)) {
    echo "Invalid family consent letter file type.";
    exit();
}

if ($family_consent_letter['size'] > 2 * 1024 * 1024) {
    echo "Family consent letter exceeds 2MB.";
    exit();
}

$coronerExt = null;

if (!empty($coroner_certificate['name'])) {

    $coronerExt = strtolower(pathinfo($coroner_certificate['name'], PATHINFO_EXTENSION));

    if (!in_array($coronerExt, $allowedTypes)) {
        echo "Invalid coroner certificate file type.";
        exit();
    }

    if ($coroner_certificate['size'] > 2 * 1024 * 1024) {
        echo "Coroner certificate exceeds 2MB.";
        exit();
    }
}

$uploadPath = "../../uploads/documents/";

if (!file_exists($uploadPath)) {
    mkdir($uploadPath, 0777, true);
}

$deathFileName = uniqid("death_") . "." . $deathExt;

move_uploaded_file(
    $death_certificate['tmp_name'],
    $uploadPath . $deathFileName
);

$familyFileName = uniqid("family_") . "." . $familyConExt;

move_uploaded_file(
    $family_consent_letter['tmp_name'],
    $uploadPath . $familyFileName
);

$coronerFileName = null;

if (!empty($coroner_certificate['name'])) {

    $coronerFileName = uniqid("coroner_") . "." . $coronerExt;

    move_uploaded_file(
        $coroner_certificate['tmp_name'],
        $uploadPath . $coronerFileName
    );
}

$verification_status = "Pending";

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

echo "success";
?>