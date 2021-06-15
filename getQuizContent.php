<?php

include "dbFunctions.php";


$id = $_GET['id'];
$questionsQuery = "SELECT QQ.question, QO.question_option FROM quiz_question QQ INNER JOIN question_option QO ON QQ.question_id = QO.question_id WHERE QQ.quiz_id = $id";
$result = mysqli_query($link, $questionsQuery);


while ($row = mysqli_fetch_assoc($result)) {
    $quizContent[] = $row["question"];
    $questionOptions[] = $row["question_option"];
}
mysqli_close($link);

echo json_encode($quizContent);
?>
