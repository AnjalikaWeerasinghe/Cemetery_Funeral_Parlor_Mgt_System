<?php
session_start();

include_once('main.php');
include_once('mailController.php');

class ForgotPasswordController extends MainController{

    public function __construct() {
        parent::__construct();
    }

   public function search_email($email){

       $sql = "SELECT * FROM user_table WHERE email = '$email' AND user_status = 1;";
       
       $result = $this->conn->query($sql);
       
       $nor = $result->num_rows;

       if($nor > 0){

        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        $update = "UPDATE user_table SET reset_token='$token', reset_token_expiry='$expiry' WHERE email='$email'";

        $this->conn->query($update);

        $resetLink = "http://127.0.0.1:8080/CFPMS/reset_password.php?token=$token";

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
            <p>This link will expire in 1 hour.</p>
        ";

        generateMail($email, "User", "Password Reset", $bodyHtml);

        return true;
       }

       else{
           return false;
       }

   }
}
?>