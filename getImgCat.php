<?php

include "dbFunctions.php";

$query = "SELECT * FROM image_category";
$result = mysqli_query($link, $query);
$return = array();

while ($row = mysqli_fetch_assoc($result)) {
$category_id = $row['image_category_id'];
$query_image = "SELECT * FROM image WHERE image_category_id = $category_id";
$result_image = mysqli_query($link, $query_image);
$return_img = array();
while($row2 = mysqli_fetch_assoc($result_image)) {
$return_img[] = $row2;
}
$row['images'] = $return_img;
$return[] = $row;
}

echo json_encode($return);