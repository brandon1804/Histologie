<?php

include "dbFunctions.php";


$id = $_GET['quiz_id'];
$query = "SELECT question_id FROM quiz_question WHERE quiz_id = $id";
$result = mysqli_query($link, $query);


while ($row = mysqli_fetch_assoc($result)) {
    $questions[] = $row["question_id"];
}

mysqli_close($link);

echo json_encode($questions);
?>