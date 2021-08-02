<?php
include '../dbFunctions.php';

$category_id = $_POST['category_id'];
$title = $_POST['title'];
$summary = $_POST['summary'];

$query = "INSERT INTO lesson (lesson_category_id, image_id, title, summary) VALUES ($category_id, $image_id, '$title', '$summary')";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

if ($result) {
    $query_get_id = "SELECT * FROM lesson WHERE title = '$title'";
    $result = mysqli_query($link, $query_get_id) or die(mysqli_error($link));
    $lesson_id = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $lesson_id = $row['lesson_id'];
    }

    $query_update_lesson_id = "UPDATE image SET lesson_id = $lesson_id WHERE image_id = $image_id";
    $result_update_lesson_id = mysqli_query($link, $query_update_lesson_id) or die(mysqli_error($link));

    if ($result_update_lesson_id) {
        echo json_encode(['output' => 'successfully updated']);
        exit();
    }
    echo json_encode(['output' => 'update failed']);
    exit();
}
echo json_encode(['output' => 'failed to create new lesson']);
exit();
