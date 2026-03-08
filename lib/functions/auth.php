<?php

session_start();

include_once('connection.php');

class Auth {

    public function __construct(){
        $this->connObj = new Connection("127.0.0.1", "root", "newStrongPassword123!", "cemetery_db");
        $this->conn = $this->connObj->conn();
    }

    function login($userName, $userPwd){

        $sql = "SELECT * FROM login_table WHERE user_email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            $rec = $result->fetch_assoc();

            if ($rec['user_status'] == 1) {

                
                if (password_verify($userPwd, $rec['login_password'])) {

                    if ($rec['user_role'] === 'Admin') {
                        session_start();
                        $_SESSION['username'] = $rec['user_name'];
                        $_SESSION['user_id'] = $rec['user_id'];
                        $_SESSION['role'] = $rec['user_role'];

                        header('Location: lib/views/admin.php');
                        exit;
                    } else {
                        echo "Please check your role!";
                    }

                } else {
                    echo "Please check your password!";
                }

            } else {
                echo "Your account is deactivated!";
            }

        } else {
            echo "User not found!";
        }
    }
}


?>