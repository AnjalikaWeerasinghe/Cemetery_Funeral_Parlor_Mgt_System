<?php
include_once("../../functions/memberController.php");

header('Content-Type: application/json');

$member = new MemberController();

$member_id = $_GET['member_id'] ?? null;

if ($member_id) {
    $result = $member->getMemberById((int)$member_id);
    echo json_encode($result);
} else {
    echo json_encode(["error" => "member_id missing"]);
}

?>
