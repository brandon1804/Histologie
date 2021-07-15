<?php

include("dbFunctions.php");
if (isset($_GET['id'])) {


    $quizID = $_GET['id'];

    $query = "SELECT questions FROM quiz WHERE quiz_id = $quizID";

    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    $row = mysqli_fetch_assoc($result);

    if (!empty($row)) {
        $quizNumOfQuestions = $row['questions'];
    }
    

}
?>