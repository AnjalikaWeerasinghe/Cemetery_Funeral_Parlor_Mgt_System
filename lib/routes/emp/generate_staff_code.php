<?php
require_once("../../functions/empController.php");

$emp = new EmpController();

echo $emp->getNewStaffCode();
?>