<?php
include_once('../../functions/memberController.php');

$memberViewObj = new MemberController();

$search = $_GET['search'] ?? '';

echo $memberViewObj->view_Member_Data($search);

?>