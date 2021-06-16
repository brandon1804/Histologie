<?php

include "dbFunctions.php";


$id = $_GET['id'];
$query = "SELECT Q.quiz_id, Q.title, Q.summary, Q.score, Q.questions, I.name FROM quiz Q INNER JOIN image I ON Q.quiz_id = I.quiz_id INNER JOIN quiz_category QC ON Q.quizcategory_id = QC.quizcategory_id WHERE QC.quizcategory_id = $id";
$result = mysqli_query($link, $query);


while ($row = mysqli_fetch_assoc($result)) {
    $quizArr[] = $row;
}
mysqli_close($link);

echo json_encode($quizArr);
?>
