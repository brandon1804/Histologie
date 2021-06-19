<?php

include "dbFunctions.php";


$id = $_GET['quiz_id'];
$query = "SELECT question_id, answer FROM quiz_answer WHERE quiz_id = $id";
$result = mysqli_query($link, $query);


while ($row = mysqli_fetch_assoc($result)) {
    $answers[] = $row;
}

mysqli_close($link);

echo json_encode($answers);
?>