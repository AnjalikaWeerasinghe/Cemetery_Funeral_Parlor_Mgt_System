<?php
include_once('../../functions/memberController.php');

$member = new MemberController();
$result = $member->deleteMember($_GET['id']);
echo($result);

?>