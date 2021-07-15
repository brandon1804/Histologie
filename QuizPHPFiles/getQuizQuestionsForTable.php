<?php

include "dbFunctions.php";


$id = $_GET['quiz_id'];
$query = "SELECT QA.question_id, QA.answer, QQ.question_score FROM quiz_answer QA INNER JOIN quiz_question QQ ON QA.question_id = QQ.question_id WHERE QA.quiz_id = $id";
$result = mysqli_query($link, $query);


while ($row = mysqli_fetch_assoc($result)) {
    $answers[] = $row;
}

mysqli_close($link);

echo json_encode($answers);
?>