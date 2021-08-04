<?php

session_start();
include "dbFunctions.php";

$id = $_POST['user_id'];
$confirmPassword = $_POST['confirmPassword'];

$query = "UPDATE user SET password = SHA1('$confirmPassword') WHERE user_id = $id ";

$result = mysqli_query($link, $query) or die(mysqli_error($link));

    if ($result) {
        $response = "Success";
    }
    
    echo json_encode($response);