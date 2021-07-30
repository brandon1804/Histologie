<?php

include "dbFunctions.php";

$studentsQuery = "SELECT COUNT(U.student_id) AS 'students_count' FROM user U";
$quizzesQuery = "SELECT COUNT(QT.user_quiz_id) AS 'quizzes_count' FROM quiz_taken QT";

$studentsResult = mysqli_query($link, $studentsQuery);
$quizzesResult = mysqli_query($link, $quizzesQuery);

$sRow = mysqli_fetch_assoc($studentsResult);
$qRow = mysqli_fetch_assoc($quizzesResult);

if (!empty($sRow)) {
    $students = $sRow['students_count'];
}

if (!empty($qRow)) {
    $quizzes = $qRow['quizzes_count'];
}

$content['students'] = $students;
$content['quizzes'] = $quizzes;

mysqli_close($link);

echo json_encode($content);
?>
