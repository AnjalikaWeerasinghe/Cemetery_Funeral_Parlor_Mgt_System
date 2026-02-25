<?php
session_start();

include_once('main.php');

class ResetPasswordController extends MainController{

    public function validateToken($token) {
        $token_validate_sql = $this->conn->prepare("SELECT id FROM user_table WHERE reset_token=? AND reset_token_expiry > NOW()");

        $token_validate_sql->bind_param("s", $token);

        $token_validate_sql->execute();

        $result = $token_validate_sql->get_result();

        return $result;

    }

    public function updatePassword($userId, $hashedPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $updatePass_Sql = $this->conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE id = ? ");

        $updateStmt->bind_param("si", $hashedPassword, $userId);

        $updateStmt->execute();
    }
}

?>