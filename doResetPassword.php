<?php

session_start();
include "dbFunctions.php";

$email = $_POST['email'];

$query = "SELECT name FROM user WHERE email = '$email'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
//$msg = "You've requested to change your password, use the link below to get started."
//        . ""
//        . "<a href='newPassword.php'>Click here</a>";
//
while ($row = mysqli_fetch_assoc($result)) {
     $name = $row["name"];
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';

// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = 'bmma.fyp@gmail.com'; // YOUR gmail email
    $mail->Password = 'xitmaj-2Begzi-wiwvoj'; // YOUR gmail password
    // Sender and recipient settings
    $mail->setFrom('bmma.fyp@gmail.com', 'Histologie');
    $mail->addAddress($email, $name);
    $mail->addReplyTo('bmma.fyp@gmail.com', 'Histology'); // to set the reply to
    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = "Send email using Gmail SMTP and PHPMailer";
    $mail->Body = 'HTML message body. <b>Gmail</b> SMTP email body.';
    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';

    $mail->send();
    
    echo "Email message sent.";
    
} catch (Exception $e) {
    echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
    
    }
?>