<?php

session_start();
include "dbFunctions.php";

$email = $_POST['email'];
$msg = "You've requested to change your password, use the link below to get started."
        . ""
        . "<a href='newPassword.php'>Click here</a>";

mail($email,"Password Reset", $msg);

//$result = mysqli_query($link, $query) or die(mysqli_error($link));

?>