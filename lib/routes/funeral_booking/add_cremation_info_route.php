<?php
require_once("../../functions/bookingController.php");

$designJson = $_POST['memorial_design'] ?? null;

$cremation_date = $_POST['cremation_date'] ?? '';
$area_type = $_POST['area_type'] ?? '';
$cremation_time_slot = $_POST['cremation_time_slot'] ?? '';
$cremation_permission = $_POST['cremation_permission'] ?? '';
$ash_collection_method = $_POST['ash_collection_method'] ?? '';
$notes = $_POST['notes'] ?? '';

if (empty($cremation_date) || empty($area_type) || empty($cremation_time_slot) || $cremation_permission === '') {
    return "Please fill the required fields.";
}

if($ash_collection_method === "memorial"){
    if(empty($designJson)){
        echo "Memorial design is required";
        exit;
    }
}

$imageName = '';

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
    $uploadPath = '../../uploads/memorial_images/' . $imageName;

    if (!move_uploaded_file($tmpName, $uploadPath)) {
        echo "Image upload failed.";
        exit();
    }
}

$data = $_POST;
$data['memorial_design'] = $designJson;
$data['memorial_image'] = $imageName ?? null;

$_SESSION['booking']['step3'] = $data;

echo "success";

// if($designJson){
//     $design = json_decode($designJson, true);

//     $name = $design['name'];
//     $message = $design['message'];
//     $font = $design['font'];
//     $theme = $design['theme'];
//     $icon = $design['icon'];
// }

// $cremationInfo = new BookingController();

// $cremationInfo->saveCremationInformation($data);

// $_SESSION['booking']['step3'] = [
//     "cremation_date" => $cremation_date,
//     "area_type" => $area_type,
//     "cremation_time_slot" => $cremation_time_slot,
//     "cremation_permission" => $cremation_permission,
//     "ash_collection_method" => $ash_collection_method,
//     "notes" => $notes,

//     "memorial_design" => $designJson,
//     "memorial_image" => isset($fileName) ? $fileName : null
// ];

?>