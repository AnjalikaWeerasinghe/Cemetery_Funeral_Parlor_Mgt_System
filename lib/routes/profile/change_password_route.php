<?php
require_once("../../functions/memberController.php");

$controller = new MemberController();

echo json_encode(

    $controller->changePassword(
        $_SESSION['user_id'],
        $_POST['current_password'],
        $_POST['new_password']
    )

);

?>