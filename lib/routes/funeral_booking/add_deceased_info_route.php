<?php
// Step 1 - Deceased and Applicant Information 
// Purpose: This route handles the submission of deceased and applicant information from the Step 1 form in the funeral booking process. 
// It validates the input, processes the uploaded image, saves the data to the database, and stores it in the session for use in subsequent 
// steps of the booking process.

require_once("../../functions/bookingController.php");
require_once("../../functions/fileUpload.php");

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
$applicant_nic = $_POST['applicant_nic'] ?? '';
$contact_number = $_POST['contact_number'] ?? '';
$email = $_POST['email'] ?? '';
$applicant_gn_division = $_POST['applicant_gn_division'] ?? '';
$applicant_address = $_POST['applicant_address'] ?? '';

$applicant_nic_front = $_FILES['applicant_nic_front'] ?? [];
$applicant_nic_back = $_FILES['applicant_nic_back'] ?? [];
$deceased_photo = $_FILES['deceased_photo'] ?? [];

if (empty($title) || empty($full_name) || empty($nic) ||empty($religion) || 
    empty($applicant_name) || empty($relationship_to_deceased) || empty($applicant_nic) || empty($contact_number) || empty($email) || empty($applicant_gn_division) || 
    empty($applicant_address)) {

    echo "Please fill the required fields.";
    exit();
}

$existingPhoto = $_SESSION['booking']['step1']['deceased_photo'] ?? null;

// Upload a deceased profile image
$imageUploaded = isset($_FILES['deceased_photo']['error']) && $_FILES['deceased_photo']['error'] === 0;

if($imageUploaded){

    $imageName = FileUpload::upload($_FILES['deceased_photo'],'deceased_photoes', ['jpg','jpeg','png','gif','webp']);

    if(!$imageName){
        echo "Image upload failed.";
        exit();
    }

} else {

    $imageName = $existingPhoto;
}

$existingNICFront = $_SESSION['booking']['step1']['applicant_nic_front'] ?? null;
$existingNICBack = $_SESSION['booking']['step1']['applicant_nic_back'] ?? null;

$nicFrontUploaded = isset($applicant_nic_front['error']) && $applicant_nic_front['error'] === 0;
$nicBackUploaded = isset($applicant_nic_back['error']) && $applicant_nic_back['error'] === 0;

if(!$nicFrontUploaded && empty($existingNICFront)){
    echo "Please upload the front side of the applicant's NIC.";
    exit();
}

if(!$nicBackUploaded && empty($existingNICBack)){
    echo "Please upload the back side of the applicant's NIC.";
    exit();
}

if($nicFrontUploaded){

    $nicFrontFileName = FileUpload::upload($applicant_nic_front, 'nic_documents', ['jpg', 'jpeg', 'png', 'pdf']);

    if (!$nicFrontFileName) {
        echo "Failed to upload NIC front.";
        exit();
    }

} else {
    $nicFrontFileName = $_SESSION['booking']['step1']['applicant_nic_front'] ?? '';
}

if($nicBackUploaded){

    $nicBackFileName = FileUpload::upload($applicant_nic_back, 'nic_documents', ['jpg', 'jpeg', 'png', 'pdf']);

    if (!$nicBackFileName) {
        echo "Failed to upload NIC back.";
        exit();
    }

} else {
    $nicBackFileName = $_SESSION['booking']['step1']['applicant_nic_back'] ?? '';
}

if (!empty($date_of_birth)) {

    $selectedDate = strtotime($date_of_birth);
    $today = strtotime(date('Y-m-d'));

    if ($selectedDate >= $today) {
        echo "Date of birth cannot be today or a future date.";
        exit();
    }
}

$_POST['deceased_photo'] = $imageName;
$_POST['applicant_nic_front'] = $nicFrontFileName;
$_POST['applicant_nic_back'] = $nicBackFileName;

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
    "applicant_nic" => $applicant_nic,
    "contact_number" => $contact_number,
    "email" => $email,
    "applicant_gn_division" => $applicant_gn_division,
    "applicant_address" => $applicant_address,

    "applicant_nic_front" => $nicFrontFileName,
    "applicant_nic_back" => $nicBackFileName
];

echo json_encode([
    "status" => "success",
    "nic_front_path" => $nicFrontFileName,
    "nic_back_path" => $nicBackFileName,
    "deceased_photo" => $imageName
]);

exit();

?>