<?php

include("dbFunctions.php");

if (isset($_POST)) {

    $isInserted = false;


    // add quiz variables
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $timeLimit = $_POST['timeLimit'];


    $insertQuizQuery = "INSERT INTO quiz(quizcategory_id, duration, score, title, summary, questions) 
                VALUES  
                (5, '$timeLimit', 1, '$title', '$summary', 1)";

    $quizInsertResult = mysqli_query($link, $insertQuizQuery) or die(mysqli_error($link));

    if ($quizInsertResult) {
        $isInserted = true;
    }//end of insert quiz result


    $quizIDQuery = "SELECT MAX(quiz_id) AS 'quizID' FROM quiz";

    $quizIDResult = mysqli_query($link, $quizIDQuery) or die(mysqli_error($link));

    $quizIDRow = mysqli_fetch_assoc($quizIDResult);

    if (!empty($quizIDRow)) {
        $quizID = $quizIDRow['quizID'];
    }

    $filename = $_FILES["quizImage"]["name"];
    $tempname = $_FILES["quizImage"]["tmp_name"];
    $upload_location = "../css/img/quizImg/";
    $completePath = $upload_location . $filename;
    $imageName = pathinfo($filename)['filename'];

    $insertQuizImageQuery = "INSERT INTO image(lesson_id, quiz_id, image_category_id, filename, name) 
                VALUES  
                (NULL, $quizID, NULL, '$filename', '$imageName')";

    $quizImageInsertResult = mysqli_query($link, $insertQuizImageQuery) or die(mysqli_error($link));


    if (move_uploaded_file($tempname, $completePath)) {
        $isInserted = true;
    } else {
        $isInserted = false;
    }

    //end of add quiz
    // add question variables
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

        mkdir("../css/img/quizImg/quiz" . strval($quizID));

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


    echo json_encode($isInserted);
}//end of POST validation
?>
