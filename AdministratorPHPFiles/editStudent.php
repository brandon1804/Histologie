<?php

include("dbFunctions.php");
if (isset($_POST)) {
    $studentId = $_POST['studentid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $account_type = $_POST['account_type'];

    $query = "UPDATE user set name='$name', set email='$email',  set $account_type='$account_type' WHERE student_id='$studentId'";

    $status = mysqli_query($link, $query) or die(mysqli_error($link));

    if ($status) {
        $response["success"] = "1";
    } else {
        $response["success"] = "0";
    }
    echo json_encode($response);
}
