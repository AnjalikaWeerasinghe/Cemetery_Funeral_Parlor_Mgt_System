<?php
include_once('../../functions/deceasedController.php');

$controller = new DeceasedController();

$keyword = $_POST['keyword'] ?? "";

echo $controller->searchGrave($keyword);

?>