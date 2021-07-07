<?php

session_start();
include "dbFunctions.php";

$userID = $_SESSION['user_id'];
$quiz_id = $_GET['quiz_id'];

$query = "SELECT QT.quiz_taken_date, Q.title, QT.user_score, Q.score FROM quiz_taken QT INNER JOIN quiz Q ON QT.quiz_id = Q.quiz_id WHERE QT.user_id = $userID AND QT.quiz_id = $quiz_id ORDER BY QT.user_quiz_id DESC LIMIT 1";
$result = mysqli_query($link, $query);

$row = mysqli_fetch_assoc($result);

if (!empty($row)) {
    $quizResult = $row;
}

$queryUser = "SELECT name from user WHERE user_id = $userID";
$resultUser = mysqli_query($link, $queryUser);

$rowUser = mysqli_fetch_assoc($resultUser);

if (!empty($row)) {
    $quizResult['user_name'] = $rowUser['name'];
}

mysqli_close($link);

echo json_encode($quizResult);
?>
