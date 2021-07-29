<?php
include '../dbFunctions.php';

$id = $_POST['id'] ?? 0;

if (!$id) {
    echo json_encode(['output' => 'invalid input']);
    exit();
}

$query = "DELETE FROM frequent_ask_questions WHERE faq_id = $id";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

if ($result) {
    echo json_encode(['output' => 'successfully deleted']);
} else {
    echo json_encode(['output' => 'delete failed']);
}
exit();