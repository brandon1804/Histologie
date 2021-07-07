<?php

session_start();
$userID = $_SESSION['user_id'];

include "dbFunctions.php";


$id = $_GET['id'];
$query = "SELECT Q.quiz_id, Q.duration, Q.title, Q.summary, Q.score, Q.questions, I.filename FROM quiz Q INNER JOIN image I ON Q.quiz_id = I.quiz_id WHERE I.quiz_id IS NOT NULL AND Q.quiz_id = $id";
$result = mysqli_query($link, $query);

$row = mysqli_fetch_assoc($result);
if (!empty($row)) {
    $quizContent = $row;
}

$queryScore = "SELECT MAX(QT.user_score) AS 'topScore', MIN(QT.user_score) AS 'minScore', COUNT(QT.user_quiz_id) AS 'attempts' FROM quiz_taken QT INNER JOIN quiz Q ON QT.quiz_id = Q.quiz_id WHERE QT.quiz_id = $id AND QT.user_id = $userID";
$resultScore = mysqli_query($link, $queryScore);

$rowScore = mysqli_fetch_assoc($resultScore);

if (!empty($rowScore)) {
    $quizContent['topScore'] = $rowScore['topScore'];
    $quizContent['minScore'] = $rowScore['minScore'];
    $quizContent['attempts'] = $rowScore['attempts'];
}


mysqli_close($link);

echo json_encode($quizContent);
?>