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

if ($output["question_type"] === "MCQ") {
    while ($row = mysqli_fetch_assoc($optionsResult)) {
        $optionsArr = $row["question_option"];
    }
} else if ($output["question_type"] === "FIB" || $output["question_type"] === "M&M") {
    while ($row = mysqli_fetch_assoc($optionsResult)) {
        $optionsArr[] = $row["question_option"];
    }
}


$output["question_options"] = $optionsArr;


$answerQuery = "SELECT QA.answer, QQ.question_score FROM quiz_answer QA INNER JOIN quiz_question QQ ON QA.question_id = QQ.question_id WHERE QQ.question_id = $question_id";
$answerResult = mysqli_query($link, $answerQuery);


$aRow = mysqli_fetch_assoc($answerResult);

if (!empty($aRow)) {
    $output["answer"] = $aRow["answer"];
    $output["question_score"] = $aRow["question_score"];
}

mysqli_close($link);


echo json_encode($output);
?>
