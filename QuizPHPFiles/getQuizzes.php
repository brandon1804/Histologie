<?php

include "dbFunctions.php";

$query = "SELECT Q.quiz_id, Q.title, Q.summary, Q.score, Q.questions, I.filename FROM quiz Q INNER JOIN image I ON Q.quiz_id = I.quiz_id WHERE I.quiz_id IS NOT NULL";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $quizzes[] = $row;
}
mysqli_close($link);

echo json_encode($quizzes);
?>

