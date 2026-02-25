<?php
session_start();

include_once('main.php');
include_once('mailController.php');

class ForgotPasswordController extends MainController{

    // public function __construct() {
    //     parent::__construct();
    // }

    public function search_user($email, $nic) {

        $result_sql = $this->conn->prepare("SELECT id FROM user_table WHERE email=? AND nic=?");

        $result_sql->bind_param("ss", $email, $nic);

        $result_sql->execute();

        $result = $result_sql->get_result();

        return $result->num_rows;

    }

    public function send_reset_email($email,$nic){

        $reset_email_sql = $this->conn->prepare("SELECT id FROM user_table WHERE email=? AND nic=?");
       
        $reset_email_sql->bind_param("ss", $email, $nic);

        $reset_email_sql->execute();

        $result = $reset_email_sql->get_result();

        // $result = $this->conn->query($sql);
       
        if ($result->num_rows == 0) {
            return false;
        }

        // if($nor > 0){
        //     generateMail($email,"Test User","Password Reset","http://127.0.0.1:8080/Cemetery_Funeral_Parlor_Mgt_System/");
        //     return true;   
        // }
     
        $token = bin2hex(random_bytes(32));
        // $tokenHash = hash('sha256', $token);
        $expiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        $update =  $this->conn->prepare("UPDATE user_table SET reset_token=?, reset_token_expiry=? WHERE email=? AND nic=?");

        $update->bind_param("ssss",$token,$expiry,$email,$nic);
        $update->execute();

        $resetLink = "http://127.0.0.1/Cemetery_Funeral_Parlor_Mgt_System/reset_password.php?token=$token";

        // when using gmail
        // $bodyHtml = "
        // <html>
        //     <body style='font-family:Arial;'>
        //         <h2>Password Reset</h2>
        //         <p>Hello,</p>
        //         <p>You requested a password reset. Click the button below:</p>
        //         <p style='text-align:center; margin:30px 0;'>
        //             <a href='$resetLink' style='padding:10px 20px; background:#2f4f4f; color:white; text-decoration:none; border-radius:5px;'>
        //                Reset Password
        //             </a>
        //         </p> 
        //         <p>This link will expire in 15 minutes.</p>
        //         <hr>
        //         <p style='font-size:12px;color:#777;'>Ignore if you did not request this.</p>
        //     </body>
        // </html>
        // ";

        
        // when using Papercut SMTP
        $bodyHtml = "
            <h3>Password Reset</h3>
            <p>Click the link below to reset your password:</p>
            <p>
                <a href='$resetLink'>$resetLink</a>
            </p>
            <p>This link will expire in 15 minutes.</p>
        ";

        $mailSent = generateMail($email, "User", "Password Reset", $bodyHtml);

        if($mailSent){
            return true;
        } else {
            return false;
        }
    }
 }
?>