<?php

include "dbFunctions.php";

//if (isset($_GET['student_id'])) {
    //$userID = $_SESSION['user_id'];
    $userID = 1;
    $query = "SELECT QT.quiz_taken_date, Q.title, QT.user_score, Q.score FROM quiz_taken QT INNER JOIN quiz Q ON QT.quiz_id = Q.quiz_id WHERE QT.user_id = $userID";
    $result = mysqli_query($link, $query);

    $row = mysqli_fetch_assoc($result);
    if(!empty($row)) {
        $quizHistory[] = $row;
    }
    mysqli_close($link);

    echo json_encode($quizHistory);
//}
?>
