<?php
require_once("../../functions/bookingController.php");

$death_certificate_number = $_POST['death_certificate_number'] ?? '';
$registrar_name = $_POST['registrar_name'] ?? '';
$date_of_death = $_POST['date_of_death'] ?? '';
$cause_of_death = $_POST['cause_of_death'] ?? '';

$death_certificate = $_FILES['death_certificate'] ?? [];

$coroner_name = $_POST['coroner_name'] ?? '';
$coroner_decision = $_POST['coroner_decision'] ?? '';

$coroner_certificate = $_FILES['coroner_certificate'] ?? '';

$cremation_permission = $_POST['cremation_permission'] ?? '';

$family_consent_letter = $_FILES['family_consent_letter'] ?? [];

if (
    empty($death_certificate_number) || empty($registrar_name) || empty($date_of_death) || empty($cause_of_death) || $cremation_permission === ''
) {
    echo "Please fill the required fields.";
    exit();
}

$existingDeathCertificate =
    $_SESSION['booking']['step2']['death_certificate'] ?? null;

$existingFamilyConsent =
    $_SESSION['booking']['step2']['family_consent_letter'] ?? null;

$deathUploaded =
    isset($death_certificate['error']) &&
    $death_certificate['error'] === 0;

$familyUploaded =
    isset($family_consent_letter['error']) &&
    $family_consent_letter['error'] === 0;

if(!$deathUploaded && empty($existingDeathCertificate)){
    echo "Please upload the death certificate.";
    exit();
}

if(!$familyUploaded && empty($existingFamilyConsent)){
    echo "Please upload the family consent letter.";
    exit();
}

$allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];

if($deathUploaded){

    $deathExt = strtolower(
        pathinfo($death_certificate['name'], PATHINFO_EXTENSION)
    );

    if (!in_array($deathExt, $allowedTypes)) {
        echo "Invalid death certificate file type.";
        exit();
    }

    if ($death_certificate['size'] > 2 * 1024 * 1024) {
        echo "Death certificate exceeds 2MB.";
        exit();
    }
}

if($familyUploaded){

    $familyConExt = strtolower(
        pathinfo($family_consent_letter['name'], PATHINFO_EXTENSION)
    );

    if (!in_array($familyConExt, $allowedTypes)) {
        echo "Invalid family consent letter file type.";
        exit();
    }

    if ($family_consent_letter['size'] > 2 * 1024 * 1024) {
        echo "Family consent letter exceeds 2MB.";
        exit();
    }
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

if($deathUploaded){

    $deathExt = strtolower(
        pathinfo($death_certificate['name'], PATHINFO_EXTENSION)
    );

    $deathFileName = uniqid("death_") . "." . $deathExt;

    if (!move_uploaded_file(
        $death_certificate['tmp_name'],
        $uploadPath . $deathFileName
    )) {
        echo "Failed to upload death certificate.";
        exit();
    }

} else {

    $deathFileName =
        $_SESSION['booking']['step2']['death_certificate'];
}

if($familyUploaded){

    $familyConExt = strtolower(
        pathinfo(
            $family_consent_letter['name'],
            PATHINFO_EXTENSION
        )
    );

    $familyFileName = uniqid("family_") . "." . $familyConExt;

    if (!move_uploaded_file(
        $family_consent_letter['tmp_name'],
        $uploadPath . $familyFileName
    )) {
        echo "Failed to upload family consent letter.";
        exit();
    }

} else {

    $familyFileName =
        $_SESSION['booking']['step2']['family_consent_letter'];
}

$coronerFileName = $_SESSION['booking']['step2']['coroner_certificate'] ?? '';;

if (!empty($coroner_certificate['name'])) {

    $coronerFileName = uniqid("coroner_") . "." . $coronerExt;

    if (!move_uploaded_file($coroner_certificate['tmp_name'], $uploadPath . $coronerFileName)) {
        echo "Failed to upload coroner certificate.";
        exit();
    }
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