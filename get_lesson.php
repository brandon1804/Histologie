<?php
include './dbFunctions.php';

$query = "SELECT * FROM lesson l INNER JOIN lesson_category lc on l.lesson_category_id = lc.lesson_category_id";

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $query = "SELECT * FROM lesson l INNER JOIN lesson_category lc on l.lesson_category_id = lc.lesson_category_id WHERE l.lesson_category_id = $category_id";
} else if (isset($_GET['lesson_id'])) {
    $lesson_id = $_GET['lesson_id'];
    $query = "SELECT * FROM lesson l INNER JOIN lesson_category lc on l.lesson_category_id = lc.lesson_category_id WHERE l.lesson_id = $lesson_id";
}

$result = mysqli_query($link, $query) or die(mysqli_error($link));
$return = array();

while ($row = mysqli_fetch_assoc($result)) {
    $lesson_id = $row['lesson_id'];
    $return_images = array();

    $query_image = "SELECT * FROM image WHERE lesson_id = $lesson_id";
    $result_images = mysqli_query($link, $query_image) or die(mysqli_error($link));
    while ($n = mysqli_fetch_assoc($result_images)) {
        $return_images[] = $n;
    }
    $row['images'] = $return_images;
    $return[] = $row;
}

echo json_encode($return);