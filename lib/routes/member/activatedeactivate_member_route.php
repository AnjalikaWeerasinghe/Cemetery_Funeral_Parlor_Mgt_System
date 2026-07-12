<?php
include_once('../../functions/memberController.php');

$member = new MemberController();

$result = $member->activateDeactivateMember($_POST['id'], $_POST['status']);

echo($result);

?>