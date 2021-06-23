<?php

include "dbFunctions.php";

$query = "SELECT L.lesson_id, L.title, L.summary, I.filename FROM lesson L INNER JOIN image I ON L.lesson_id = I.lesson_id WHERE I.lesson_id IS NOT NULL";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $lessons[] = $row;
}
mysqli_close($link);

echo json_encode($lessons);
?>

