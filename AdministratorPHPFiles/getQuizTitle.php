<?php

session_start();
include "dbFunctions.php";


$quiz_id = $_GET['quiz_id'];

$query = "SELECT Q.title FROM quiz Q WHERE Q.quiz_id = $quiz_id";
$result = mysqli_query($link, $query);

$row = mysqli_fetch_assoc($result);

if (!empty($row)) {
    $output = $row;
}

echo json_encode($output);

?>

