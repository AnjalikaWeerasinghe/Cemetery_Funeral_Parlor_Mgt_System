<?php 
include_once('../functions/memberController.php');

$memberObj = new MemberController();

echo $memberObj->registerNewMember($_POST);

?>