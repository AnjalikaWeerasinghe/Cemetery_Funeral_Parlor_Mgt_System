<?php
include_once('../../functions/memberController.php');

$memberViewObj = new MemberController();
$result = $memberViewObj->view_Member_Data();
echo($result);

?>