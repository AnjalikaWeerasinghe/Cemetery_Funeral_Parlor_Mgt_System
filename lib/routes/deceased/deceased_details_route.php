<?php
include_once('../../functions/deceasedController.php');

$search = $_GET['search'] ?? '';
$religion = $_GET['religion'] ?? '';
$service_type = $_GET['service_type'] ?? '';

$deceasedViewObj = new DeceasedController();

$deceasedViewObj->view_Deceased_Data(
    $search,
    $religion,
    $service_type
);

?>