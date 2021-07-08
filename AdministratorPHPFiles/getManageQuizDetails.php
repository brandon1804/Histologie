<?php

session_start();
include "dbFunctions.php";


$quiz_id = $_GET['quiz_id'];

$query = "SELECT Q.title, COUNT(DISTINCT QT.user_id) AS 'quizzesCompleted', AVG(QT.user_score) AS 'average_score', MAX(QT.user_score) AS 'highest_score', Q.score FROM quiz_taken QT INNER JOIN quiz Q ON QT.quiz_id = Q.quiz_id INNER JOIN user U ON QT.user_id = U.user_id WHERE QT.quiz_id = $quiz_id AND U.account_type = 'student'";
$result = mysqli_query($link, $query);

$row = mysqli_fetch_assoc($result);

if (!empty($row)) {
    $output = $row;
    $topScore = $row['highest_score'];
}


$tsQuery = "SELECT U.name, U.student_id FROM user U INNER JOIN quiz_taken QT ON U.user_id = QT.user_id WHERE QT.quiz_id = $quiz_id AND QT.user_score = $topScore";
$tsResult = mysqli_query($link, $tsQuery);
$tsRow = mysqli_fetch_assoc($tsResult);

if (!empty($tsRow)) {
    $output['top_scorer_name'] = $tsRow['name'];
    $output['student_id'] = $tsRow['student_id'];
}

$studentsQuery = "SELECT COUNT(U.student_id) AS 'students_count' FROM user U";
$studentsResult = mysqli_query($link, $studentsQuery);

$sRow = mysqli_fetch_assoc($studentsResult);
if (!empty($sRow)) {
    $students = $sRow['students_count'];
}

$output['students'] = $students;


$rankingsQuery = "SELECT U.student_id, U.name, MAX(QT.user_score) AS 'user_score', QT.quiz_taken_date FROM user U INNER JOIN quiz_taken QT ON U.user_id = QT.user_id WHERE QT.quiz_id = $quiz_id GROUP BY U.user_id ORDER BY MAX(QT.user_score) DESC";
$rankingsResult = mysqli_query($link, $rankingsQuery);

while ($rRow = mysqli_fetch_assoc($rankingsResult)) {
    $rankings[] = $rRow;
}


$output['rankings'] = $rankings;

mysqli_close($link);

echo json_encode($output);
?>
