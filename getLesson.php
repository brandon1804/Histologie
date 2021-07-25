<?php

include "dbFunctions.php";

$query = "SELECT I.lesson_image_id, L.title, L.summary, I.filename FROM lesson L INNER JOIN image I ON L.lesson_id = I.lesson_image_id WHERE I.lesson_image_id IS NOT NULL";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_assoc($result)) {
$lessons[] = $row;
}
mysqli_close($link);

echo json_encode($lessons);
?>

