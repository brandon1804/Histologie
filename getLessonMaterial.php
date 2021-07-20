<?php

include "dbFunctions.php";
$id = $_GET['id'];

$query = "SELECT L.title, I.filename from image I INNER JOIN lesson L ON I.lesson_id = L.lesson_id WHERE I.lesson_id = $id";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $lessons['title'] = $row['title'];
    $slides[] = $row['filename'];
}
mysqli_close($link);
$lessons['slides'] = $slides;
echo json_encode($lessons);
?>
