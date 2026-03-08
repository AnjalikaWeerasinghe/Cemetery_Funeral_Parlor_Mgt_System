<?php
include_once('../../functions/empController.php');

$empViewObj = new EmpController();
$result = $empViewObj->view_Staff_Data();
echo($result);

?>