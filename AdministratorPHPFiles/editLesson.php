<?php 
include '../dbFunctions.php';

$lesson_id = $_POST['lesson_id'];
$category_id = $_POST['category_id'];
$title = $_POST['title'];
$summary = $_POST['summary'];

$query = "UPDATE lesson SET lesson_category_id = $category_id, title = '$title', summary = '$summary' WHERE lesson_id = $lesson_id";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

if ($result) {
    echo json_encode(['output' => 'successfully update']);
    exit();
}
echo json_encode(['output' => 'update failed']);
exit();