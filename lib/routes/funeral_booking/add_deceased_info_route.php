<?php
// Step 1 - Deceased and Applicant Information 
// Purpose: This route handles the submission of deceased and applicant information from the Step 1 form in the funeral booking process. 
// It validates the input, processes the uploaded image, saves the data to the database, and stores it in the session for use in subsequent 
// steps of the booking process.

require_once("../../functions/bookingController.php");

// var_dump($_POST['service_type']);
// exit;

$service_type = $_POST['service_type'] ?? '';

$full_name = $_POST['full_name'] ?? '';
$title = $_POST['title'] ?? '';
$religion = $_POST['religion'] ?? '';
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

$imageName = '';

if (!empty($_FILES['deceased_photo']['name'])) {

    $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $originalName = $_FILES['deceased_photo']['name'];
    $tmpName = $_FILES['deceased_photo']['tmp_name'];
    $imageExt = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    if (!in_array($imageExt, $allowedExts)) {
        echo "Invalid image file type.";
        exit();
    }

    if ($_FILES['deceased_photo']['size'] > 2 * 1024 * 1024) {
        echo "Image exceeds 2MB.";
        exit();
    }

    $imageName = uniqid('img_') . '.' . $imageExt;
    $uploadPath = '../../uploads/images/' . $imageName;

    if (!move_uploaded_file($tmpName, $uploadPath)) {
        echo "Image upload failed.";
        exit();
    }
}

if (empty($full_name) || empty($nic) || empty($applicant_name) || empty($relationship_to_deceased) || empty($contact_number) || 
    empty($applicant_address)) {

    echo "Please fill the required fields.";
    exit();
}

$deceasedinfo = new BookingController();

$deceasedinfo->saveDeceasedInformation($_POST, $_FILES);

// Store the submitted data in the session for later use in the booking process
$_SESSION['booking']['step1'] = [
    "service_type" => $service_type,

    "full_name" => $full_name,
    "title" => $title,
    "religion" => $religion,
    "nic" => $nic,
    "gender" => $gender,
    "date_of_birth" => $date_of_birth,
    "deceased_address" => $deceased_address,
    "deceased_gn_division" => $deceased_gn_division,
    "municipal_council" => $municipal_council,
    "deceased_photo" => $imageName,
    
    "applicant_name" => $applicant_name,
    "relationship_to_deceased" => $relationship_to_deceased,
    "contact_number" => $contact_number,
    "email" => $email,
    "applicant_gn_division" => $applicant_gn_division,
    "applicant_address" => $applicant_address
];

echo "success";

?>