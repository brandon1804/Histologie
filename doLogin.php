<?php

session_start();
include "dbFunctions.php";

$email = $_POST['email'];
$password = $_POST['password'];
$message = "";

$query = "SELECT * FROM user WHERE email = '$email' and password = SHA1('$password')";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['account_type'] = $row['account_type'];

    if ($_SESSION['account_type'] === "student") {
        $message = "<div class='alert alert-success text-left' role='alert'>"
                . "You have logged in successfully"
                . "<a href='learnPage.php'> Continue</a></div>";
    }//end of student validation
    else if ($_SESSION['account_type'] === "staff") {
        $message = "<div class='alert alert-success text-left' role='alert'>"
                . "You have logged in successfully"
                . "<a href='dashboard.php'> Continue</a></div>";
    }//end of staff validation
} 

else {
    $message = "<div class='alert alert-danger text-left' role='alert'>"
            . "Sorry, you must enter a valid username and password to log in."
            . "<a href='signinpage.php'> Try again</a></div>";
}

echo $message;
?>

