<?php 
include '../dbFunctions.php';

$lesson_id = $_POST['lesson_id'];

$query = "DELETE FROM lesson WHERE lesson_id = $lesson_id";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

if ($result) {
    echo json_encode(['output' => 'successfully delete']);
    exit();
} 
echo json_encode(['output' => 'deletion failed']);
exit();