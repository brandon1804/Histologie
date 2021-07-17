<?php

include("dbFunctions.php");

if (isset($_POST)) {

    $isInserted = false;

    // add question variables
    $quizID = $_POST['quiz_id'];
    $question = $_POST['question'];
    $questionType = $_POST['questionType'];
    $questionScore = $_POST['questionScore'];
    $questionAnswer = $_POST['questionAnswer'];
    $questionOption = $_POST['questionOption'];
    $insertAmount = $_POST['insertAmount'];



    $insertQuizQuestionQuery = "INSERT INTO quiz_question(quiz_id, question_type, question_score, question) 
                VALUES  
                ($quizID, '$questionType', $questionScore, '$question')";

    $insertQuizQuestionResult = mysqli_query($link, $insertQuizQuestionQuery) or die(mysqli_error($link));

    if ($insertQuizQuestionResult) {
        $isInserted = true;
    }//end of insert quiz question result
    else {
        $isInserted = false;
    }


    $questionIDQuery = "SELECT MAX(question_id) AS 'questionID' FROM quiz_question";

    $questionIDResult = mysqli_query($link, $questionIDQuery) or die(mysqli_error($link));

    $questionIDRow = mysqli_fetch_assoc($questionIDResult);

    if (!empty($questionIDRow)) {
        $questionID = $questionIDRow['questionID'];
    }

    $insertQuizAnswerQuery = "INSERT INTO quiz_answer(quiz_id, question_id, answer) 
                VALUES  
                ($quizID, $questionID, '$questionAnswer')";

    $insertQuizAnswerResult = mysqli_query($link, $insertQuizAnswerQuery) or die(mysqli_error($link));

    if ($insertQuizAnswerResult) {
        $isInserted = true;
    }//end of insert quiz result
    else {
        $isInserted = false;
    }



    for ($o = 0; $o < $insertAmount; $o++) {

        $insertOptionsQuery = "";

        if (substr($questionOption, 0, 1) === "0") {
            $insertOptionsQuery = "INSERT INTO question_option(question_id, question_option) 
                VALUES  
                ($questionID, '$o')";
            $insertOptionsResult = mysqli_query($link, $insertOptionsQuery) or die(mysqli_error($link));
        }//end of no options
        else {
            $insertOptionsQuery = "INSERT INTO question_option(question_id, question_option) 
                VALUES  
                ($questionID, '$questionOption')";
            $insertOptionsResult = mysqli_query($link, $insertOptionsQuery) or die(mysqli_error($link));
        }
    }//end of options loop



    if (isset($_FILES['files'])) {

        $countfiles = count($_FILES['files']['name']);

        $upload_location = "../css/img/quizImg/quiz" . strval($quizID) . "/";

        $files_arr = array();

        for ($i = 0; $i < $countfiles; $i++) {

            if (isset($_FILES['files']['name'][$i]) && $_FILES['files']['name'][$i] != '') {

                $questionImgName = $_FILES['files']['name'][$i];

                $insertQuestionImageQuery = "INSERT INTO question_image(question_id, name) VALUES ($questionID, '$questionImgName')";

                $questionImageInsertResult = mysqli_query($link, $insertQuestionImageQuery) or die(mysqli_error($link));

                $completePath = $upload_location . $questionImgName;

                if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $completePath)) {
                    $files_arr[] = $completePath;
                }
            }
        }//end of image loop
    }//end of image validation
    else {
        $noImageQuery = "INSERT INTO question_image(question_id, name) 
                VALUES  
                ($questionID, 'None')";
        $noImageInsertResult = mysqli_query($link, $noImageQuery) or die(mysqli_error($link));
    }//end of no images


    $marksQuery = "SELECT score, questions FROM quiz WHERE quiz_id = $quizID";

    $marksResult = mysqli_query($link, $marksQuery) or die(mysqli_error($link));

    $marksRow = mysqli_fetch_assoc($marksResult);

    if (!empty($marksRow)) {
        $quizMarks = $marksRow['score'];
        $quizQuestions = $marksRow['questions'];
    }


    $quizMarks += $questionScore;
    $quizQuestions += 1;

    $updateQuizQuery = "UPDATE quiz SET score=$quizMarks, questions=$quizQuestions WHERE quiz_id=$quizID";

    $updateQuizResult = mysqli_query($link, $updateQuizQuery) or die(mysqli_error($link));

    if ($updateQuizResult) {
        $isInserted = true;
    }//end of update quiz
    else {
        $isInserted = false;
    }
    if ($isInserted) {
        echo $quizID;
    }
}//end of POST validation
?>
