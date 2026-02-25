<?php
include_once('../functions/forgot_passwordController.php');

if(isset($_POST['email']) && isset($_POST['nic'])){

    $email = $_POST['email'];
    $nic = $_POST['nic'];

    $forgotPwd = new ForgotPasswordController();
    $isEmailSent = $forgotPwd->send_reset_email($email,$nic);
    
    if($isEmailSent){
        echo "sent";
    }
    else{
        echo "error";
    }
}
exit();

?>