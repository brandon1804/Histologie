<?php

include "dbFunctions.php";


$id = $_GET['id'];
$query = "SELECT L.lesson_id, L.title, L.summary, I.filename FROM lesson L INNER JOIN image I ON L.lesson_id = I.lesson_image_id INNER JOIN lesson_category LC ON L.lesson_category_id = LC.lesson_category_id WHERE LC.lesson_category_id = $id";
$result = mysqli_query($link, $query);

$row = mysqli_fetch_assoc($result);
if (!empty($result)){
    $lessonArr = $row;
}

mysqli_close($link);



echo json_encode($lessonArr);
?>

