<?php
include '../dbFunctions.php';

$id = $_POST['id'] ?? 0;
$question = $_POST['question'] ?? "";
$answer = $_POST['answer'] ?? "";

if (!($id && $question && $answer)) {
    echo json_encode(['output' => 'invalid input']);
    exit();
}

$query = "UPDATE frequent_ask_questions SET faq_title = '$question', faq_answer = '$answer' WHERE faq_id = $id";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

if ($result) {
    echo json_encode(['output' => 'successfully updated']);
} else {
    echo json_encode(['output' => 'update failed']);
}
exit();