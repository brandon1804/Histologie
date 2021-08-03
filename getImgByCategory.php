<?php

include "dbFunctions.php";

$category_id = $_GET['category_id'];
$query = "SELECT * from image_category INNER JOIN image i ON image_category.image_category_id = i.image_category_id WHERE image_category_id = $category_id";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $imageArr[] = $row;
}
mysqli_close($link);

echo json_encode($imageArr);
?>
