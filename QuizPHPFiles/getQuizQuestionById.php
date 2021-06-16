<?php
include "dbFunctions.php";

$quiz_id = $_GET['quiz_id'];
$question_id = $_GET['question_id'];


$questionQuery = "SELECT QQ.question, QQ.question_type, QI.name FROM quiz_question QQ INNER JOIN question_image QI ON QQ.question_id = QI.question_id WHERE QQ.quiz_id = $quiz_id AND QQ.question_id = $question_id AND QI.question_id = $question_id";
$questionResult = mysqli_query($link, $questionQuery);

$questionOptionsQuery = "SELECT QO.question_option FROM question_option QO WHERE QO.question_id = $question_id";
$optionsResult = mysqli_query($link, $questionOptionsQuery);


while ($row = mysqli_fetch_assoc($questionResult)) {
    $output["question"] = $row["question"];
    $output["question_type"] = $row["question_type"];
    $imgArr[] = $row["name"];
}

$output["images"] = $imgArr;

while ($row = mysqli_fetch_assoc($optionsResult)) {
    $optionsArr[] = $row["question_option"];
}

$output["question_options"] = $optionsArr;


mysqli_close($link);


echo json_encode($output);

?>
