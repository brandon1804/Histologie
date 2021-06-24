<?php

include "dbFunctions.php";

$imagesQuery = "SELECT COUNT(I.image_id) AS 'images' FROM image I";
$lessonsQuery = "SELECT COUNT(L.lesson_id) AS 'lessons_count' FROM lesson L";
$quizzesQuery = "SELECT COUNT(Q.quiz_id) AS 'quizzes_count' FROM quiz Q";

$imagesResult = mysqli_query($link, $imagesQuery);
$lessonsResult = mysqli_query($link, $lessonsQuery);
$quizzesResult = mysqli_query($link, $quizzesQuery);

$iRow = mysqli_fetch_assoc($imagesResult);
$qRow = mysqli_fetch_assoc($quizzesResult);
$lRow = mysqli_fetch_assoc($lessonsResult);

if (!empty($iRow)) {
    $images = $iRow['images'];
}
if (!empty($lRow)) {
    $lessons = $lRow['lessons_count'];
}
if (!empty($qRow)) {
    $quizzes = $qRow['quizzes_count'];
}

$content['images'] = $images;
$content['lessons'] = $lessons;
$content['quizzes'] = $quizzes;

mysqli_close($link);

echo json_encode($content);
?>
