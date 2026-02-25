<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/Exception.php';
require_once __DIR__ . '/PHPMailer.php';
require_once __DIR__ . '/SMTP.php';

function generateMail($to, $toName, $subject, $bodyHtml) {

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();

        //using Papercut SMTP
        $mail->Host       = '127.0.0.1'; // smtp.gmail.com - when using gmail
        $mail->SMTPAuth   = false; // true - with gmail

        // need when using gmail
        // $mail->Username   = 'anjalee362@gmail.com';
        // $mail->Password   = getenv('MAIL_PASSWORD');

        $mail->SMTPSecure = false; // PHPMailer::ENCRYPTION_STARTTLS - for gmail
        $mail->Port       = 25; // 587 - for gmail

        // $mail->SMTPDebug = 2; // for testing to see email credentials, SMTP conversation

        $mail->setFrom('anjalee362@gmail.com', 'Gampola Urban Council');
        $mail->addAddress($to, $toName);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $bodyHtml;

        $mail->send();
        return true;

    } catch (Exception $e) {
        return false; 
    }

}

?>