<?php

session_start();
include "dbFunctions.php";

$name = $_POST['name'];
$id = $_POST['id'];
$email = $_POST['email'];
$password = $_POST['password'];
$accountType = $_POST['accountType'];

$query = "";

if ($accountType == "student") {
    $query = "INSERT INTO user (name, student_id, staff_id, email, password, account_type) VALUES ('$name', $id, NULL, '$email', SHA1('$password'), '$accountType')";
} else if ($accountType == "staff") {
    $query = "INSERT INTO user (name, student_id, staff_id, email, password, account_type) VALUES ('$name', NULL, $id, '$email', SHA1('$password'), '$accountType')";
}

$result = mysqli_query($link, $query) or die(mysqli_error($link));

if ($result) {
    $response = "<div class='alert alert-success text-left' role='alert'>"
            . "You have signed up successfully"
            . "<a href='signinPage.php'> Continue</a></div>";
} else {
    $response = "<div class='alert alert-danger text-left' role='alert'>"
            . "Sign up failed."
            . "<a href='signinpage.php'> Try again</a></div>";
}

echo $response;
?>

