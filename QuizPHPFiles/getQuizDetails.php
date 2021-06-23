<?php

include "dbFunctions.php";


    $id = $_GET['id'];
    $query = "SELECT Q.quiz_id, Q.duration, Q.title, Q.summary, Q.score, Q.questions, I.filename FROM quiz Q INNER JOIN image I ON Q.quiz_id = I.quiz_id WHERE I.quiz_id IS NOT NULL AND Q.quiz_id = $id";
    $result = mysqli_query($link, $query);

    $row = mysqli_fetch_assoc($result);
    if(!empty($row)) {
        $quizContent = $row;
    }
    mysqli_close($link);

    echo json_encode($quizContent);
?>