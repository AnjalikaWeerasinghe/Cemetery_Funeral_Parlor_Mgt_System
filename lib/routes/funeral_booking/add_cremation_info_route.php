<?php
require_once("../../functions/bookingController.php");

$cremation_date = $_POST['cremation_date'] ?? '';
$area_type = $_POST['area_type'] ?? '';
$schedule_slots_table_slot_id = $_POST['schedule_slots_table_slot_id'] ?? '';
$collect_ash = $_POST['collect_ash'] ?? '';
$ash_collection_method = $_POST['ash_collection_method'] ?? '';
$notes = $_POST['notes'] ?? '';

$designJson = $_POST['memorial_design'] ?? null;

if (empty($cremation_date) || empty($area_type) || empty($schedule_slots_table_slot_id) || $collect_ash === '') {
    echo "Please fill the required fields.";
    exit();
}

$imageName = '';

if($ash_collection_method === "memorial"){
    if(empty($designJson)){
        echo "Memorial design is required";
        exit;
    }
}

if($collect_ash === "1" && $ash_collection_method === "memorial"){
    echo "Invalid ash collection method.";
    exit();
}

if ($ash_collection_method === "memorial" && !empty($_FILES['memorial_image']['name'])) {

    $allowedExts = ['jpg', 'jpeg', 'png', 'webp'];
    $originalName = $_FILES['memorial_image']['name'];
    $tmpName = $_FILES['memorial_image']['tmp_name'];
    $imageExt = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    if (!in_array($imageExt, $allowedExts)) {
        echo "Invalid image file type.";
        exit();
    }

    if($_FILES['memorial_image']['size'] > 2 * 1024 * 1024){
        echo "Image too large. Max 2MB allowed.";
        exit();
    }

    $imageName = uniqid('img_') . '.' . $imageExt;

    $uploadDir = '../../uploads/memorial_images/';

    if(!file_exists($uploadDir)){
        mkdir($uploadDir, 0777, true);
    }

    $uploadPath = $uploadDir . $imageName;

    if (!move_uploaded_file($tmpName, $uploadPath)) {
        echo "Image upload failed.";
        exit();
    }
}

$memorial_image = $imageName;

$_SESSION['booking']['step3'] = [
    "cremation" => [
        "cremation_date" => $cremation_date,
        "area_type" => $area_type,
        "schedule_slots_table_slot_id" => $schedule_slots_table_slot_id,
        "collect_ash" => $collect_ash,
        "notes" => $notes
    ],

    "ash_collection_method" => $ash_collection_method,

    "memorial" => ($ash_collection_method === "memorial") ? [
        "design" => $designJson,
        "image" => $imageName
    ] : null

];

$cremationinfo = new BookingController();

$cremationinfo->saveCremationInformation($_POST);

echo "success";

?>