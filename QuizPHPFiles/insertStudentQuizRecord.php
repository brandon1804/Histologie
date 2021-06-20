<?php

session_start();
include "dbFunctions.php";

$user_id = $_SESSION['user_id'];

if (isset($_POST)) {

    $quiz_id = $_POST['quiz_id'];
    $marks = $_POST['marks'];

    $query = "INSERT INTO quiz_taken (user_id, quiz_id, quiz_taken_date, user_score) VALUES ('$user_id', '$quiz_id', CURDATE(), '$marks')";


    $status = mysqli_query($link, $query) or die(mysqli_error($link));

    if ($status) {
        $response["success"] = "1";
    } else {
        $response["success"] = "0";
    }
    echo json_encode($response);
}//end of isset
?>
