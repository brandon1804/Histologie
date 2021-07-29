<?php
include '../dbFunctions.php';

$question = $_POST['question'] ?? "";
$answer = $_POST['answer'] ?? "";

if (!($question && $answer)) {
    echo json_encode(['output' => 'invalid input']);
    exit();
}

$query = "INSERT INTO frequent_ask_questions (faq_title, faq_answer) VALUES ('$question', '$answer');";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

if ($result) {
    echo json_encode(['output' => 'successfully inserted']);
} else {
    echo json_encode(['output' => 'insertion failed']);
}
exit();