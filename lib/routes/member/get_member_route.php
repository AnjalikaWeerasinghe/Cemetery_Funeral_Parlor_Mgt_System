<?php
include_once("../../functions/memberController.php");

header('Content-Type: application/json');

$member = new MemberController();

if (isset($_POST['member_id']) && !empty($_POST['member_id'])) {

    $member_id = intval($_POST['member_id']);

    $result = $member->getMemberById($member_id);

    if ($result) {
        echo json_encode([
            "status" => "success",
            "data" => $result
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Member not found"
        ]);
    }

} else {
    echo json_encode([
        "status" => "error",
        "message" => "member_id not provided"
    ]);
}
?>


<!-- <br />
<b>Warning</b>:  Undefined array key "member_id" in <b>C:\xampp3\htdocs\Cemetery_Funeral_Parlor_Mgt_System\lib\routes\member\get_member_route.php</b> on line <b>6</b><br />
null -->