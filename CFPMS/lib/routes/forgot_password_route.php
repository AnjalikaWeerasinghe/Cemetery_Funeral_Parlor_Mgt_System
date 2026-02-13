<?php
include_once('../functions/forgot_passwordController.php');

$forgotPwd = new ForgotPasswordController();

if(isset($_POST['email'])){

    $email = $_POST['email'];

    $isEmailExist = $forgotPwd->search_email($email);
    
    if($isEmailExist){
        echo "Email found. Further instructions have been sent to your email.";
    }
    else{
        echo "Email not found in our records.";
    }
}
?>