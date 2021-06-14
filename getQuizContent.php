<?php

include "dbFunctions.php";


    $id = $_GET['id'];
    $query = "SELECT QQ.question FROM quiz Q INNER JOIN quiz_question QQ ON Q.quiz_id = QQ.quiz_id WHERE Q.quiz_id = $id";
    $result = mysqli_query($link, $query);

    $row = mysqli_fetch_assoc($result);
    if(!empty($row)) {
        $quizContent[] = $row;
    }
    mysqli_close($link);

    echo json_encode($quizContent);
?>
