<?php
include '../dbFunctions.php';

$lesson_id = $_POST['lesson_id'];
$image_id = $_POST['image_id'];

$image_path = "css/img/lessonImage/";

$query_lesson = "SELECT * FROM lesson l INNER JOIN lesson_category lc on l.lesson_category_id = lc.lesson_category_id WHERE l.lesson_id = $lesson_id";
$result_lesson = mysqli_query($link, $query_lesson) or die(mysqli_error($link));

while ($row = mysqli_fetch_assoc($result_lesson)) {
    $image_path .= $row['name'];
}

$query_image = "SELECT * FROM image WHERE image_id = $image_id";
$result_image = mysqli_query($link, $query_image) or die(mysqli_error($link));

while ($row = mysqli_fetch_assoc($result_image)) {
    $image_path .= $row['filename'];
}

if (!unlink($image_path)) { 
    echo json_encode(['output' => "$image_path cannot be deleted"]); 
    exit();
} else { 
    $query_delete_image = "DELETE FROM image WHERE image_id = $image_id";
    $result_delete_image = mysqli_query($link, $query) or die(mysqli_error($link));

    if ($result_delete_image) {
        echo json_encode(['output' => "image successfully deleted"]);
        exit();
    } else {
        echo json_encode(['output' => "image fail to delete"]);
        exit();
    }
} 