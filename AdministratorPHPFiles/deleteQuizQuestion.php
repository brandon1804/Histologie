<?php

include("dbFunctions.php");
if (isset($_GET['question_id'])) {
    $id = $_GET['question_id'];

$query = "DELETE FROM quiz_question WHERE question_id ='$id'";
//echo $insertQuery;
$status = mysqli_query($link, $query) or die(mysqli_error($link));

if ($status) {
    $response["success"] = "1";
} else {
    $response["success"] = "0";
}
echo json_encode($response);
}
