<?php
include_once("../../functions/empController.php");

$user = new EmpController();
$result = $user->getDatatoEdit($_GET['id']);
echo($result);

?>