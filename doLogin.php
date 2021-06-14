<?php

include "dbFunctions.php";

$email = $_POST['email'];
$password = $_POST['password'];
$message="";

$query = "SELECT * FROM user WHERE email = '$email' and password = SHA1('$password')";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

if (mysqli_num_rows($result) == 1){
    $row = mysqli_fetch_array($result);
    $_SESSION['user_id'] = $row['user_id'];
    $message = "<div class='alert alert-success' role='alert'>"
            ."You have logged in successfully"
            ."<a href='index.php'>Continue</a></div>";
}else {
    $message = "<div class='alert alert-danger' role='alert'>"
            ."Sorry, you must enter a valid username and password to log in."
            ."<a href='login.php'>Try again</a></div>";
}

echo $message;

?>

