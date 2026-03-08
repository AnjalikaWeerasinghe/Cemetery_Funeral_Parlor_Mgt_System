<?php
require_once("../../functions/memberController.php");

$member = new MemberController();

echo $member->getNewMemberCode();
?>