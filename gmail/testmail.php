<?php

session_start();
include "dbFunctions.php";

$email = $_POST['email'];


$query = "SELECT user_id, name FROM user WHERE email = '$email'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

while ($row = mysqli_fetch_assoc($result)) {
    $name = $row["name"];
    $id = $row["user_id"];
}
 
 $msg = "You've requested to change your password, use the link below to get started."
        . ""
        . "<a href='localhost/Histologie/newPassword.php?user_id=" + $id + "'>Click here</a>";

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";

$mail->SMTPDebug = 1;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port = 587;
$mail->Host = "smtp.gmail.com";
$mail->Username = "bmma.fyp@gmail.com";
$mail->Password = "gemgnppveivzjtmf";

$mail->IsHTML(true);
$mail->AddAddress("$email", "$name");
$mail->SetFrom("bmma.fyp@gmail.com", "Histologie");
$mail->AddReplyTo("bmma.fyp@gmail.com", "Histologie Reply");
//$mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");
$mail->Subject = "You've requested for a password reset.";
$content = "<b>$msg</b>";

$mail->MsgHTML($content);
if (!$mail->Send()) {
    echo "Error while sending Email.";
    var_dump($mail);
} else {
    echo "Email sent successfully";
}

echo "test";
?>