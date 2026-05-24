<?php
include_once('../../functions/deceasedController.php');

$deceasedViewObj = new DeceasedController();
$result = $deceasedViewObj->view_Deceased_Data();
echo($result);

?>