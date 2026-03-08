<?php
include_once('../../functions/roleController.php');

$roleViewObj = new RoleController();
$result = $roleViewObj->view_Role_Data();
echo($result);

?>