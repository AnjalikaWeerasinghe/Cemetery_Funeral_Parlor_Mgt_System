<?php
require_once("../../functions/bookingController.php");

$district = $_POST["district"];
$urban_council_division = $_POST["urban_council_division"];
$parlor_name = $_POST["parlor_name"];

$start_date = $_POST["start_date"];
$start_time = $_POST["start_time"];
$end_date = $_POST["end_date"];
$end_time = $_POST["end_time"];

$total_cost = $_POST["parlor_cost"];

if (empty($start_date) || empty($start_time) || empty($end_date) || empty($end_time)) {
    echo "Please fill the required fields.";
    exit();
}

$parlorInfo = new BookingController();

$parlorInfo->saveParlorInformation($_POST);

$_SESSION['booking']['step3'] = [
    "parlor_reservation" => [
        "district" => $district,
        "urban_council_division" => $urban_council_division,
        "parlor_name" => $parlor_name,

        "start_date" => $start_date,
        "start_time" => $start_time,
        "end_date" => $end_date,
        "end_time" => $end_time,

        "total_cost" => $total_cost
    ]
];

echo "success";

?>