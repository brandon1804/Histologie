<?php

include("dbFunctions.php");

if (isset($_POST)) {

    $studentId = $_POST['studentid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $accountType = $_POST['lastname'];

    $insertQuery = "INSERT INTO USER(name, student_id, staff_id, email, account_type) 
                VALUES  
                ('$name', '$studentId', NULL, '$email', '$accountType')";

    $status = mysqli_query($link, $insertQuery) or die(mysqli_error($link));

    if ($status) {
        $response["success"] = "1";
    } else {
        $response["success"] = "0";
    }
    echo json_encode($response);
}
