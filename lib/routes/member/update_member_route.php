<?php
include_once("../../functions/memberController.php");

$member = new MemberController();

$result = $member->updateMember($_POST);

echo $result;

?>