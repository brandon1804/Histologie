<?php

include "dbFunctions.php";


$id = $_GET['quiz_id'];
$query = "SELECT QQ.question_id, QQ.question, QQ.question_score, QQ.question_type, QA.answer, QQ.quiz_id FROM quiz_question QQ INNER JOIN quiz_answer QA ON QQ.quiz_id = QA.quiz_id WHERE QQ.quiz_id = $id AND QQ.question_id = QA.question_id";
$result = mysqli_query($link, $query);


while ($row = mysqli_fetch_assoc($result)) {
    $output[] = $row;
}

mysqli_close($link);

echo json_encode($output);
?>