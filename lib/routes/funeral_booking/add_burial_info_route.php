<?php 
require_once("../../functions/bookingController.php");

$burial_date = $_POST['burial_date'] ?? '';
$area_type = $_POST['area_type'] ?? '';
$grave_type = $_POST['grave_type'] ?? '';
$section_id = $_POST['section_id'] ?? '';
$request_note = $_POST['request_note'] ?? '';

if (
    empty($burial_date) || empty($area_type) || empty($grave_type) || empty($section_id)
) {
    echo "Please fill the required fields.";
    exit();
}

$_SESSION['booking']['step3'] = [
    "burial" => [
        "burial_date" => $burial_date,
        "area_type" => $area_type,
        "grave_type" => $grave_type,
        "section_id" => $section_id,
        "request_note" => $request_note
    ]
];

$booking = new BookingController();

$booking->saveBurialInformation($_POST);

echo "success";

?>