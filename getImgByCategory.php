<?php

include "dbFunctions.php";


$id = $_GET['id'];
$query = "SELECT I.filename, I.name FROM image I INNER JOIN image_category IC ON IC.image_category_id = I.image_category_id WHERE IC.image_category_id = $id";
$result = mysqli_query($link, $query);


while ($row = mysqli_fetch_assoc($result)) {
    $lessonArr[] = $row;
}
mysqli_close($link);

echo json_encode($lessonArr);
?>

