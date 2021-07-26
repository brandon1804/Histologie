<?php

include("dbFunctions.php");

if (isset($_POST)) {

    $isUpdated = false;

    // add question variables
    $quizID = $_POST['quiz_id'];
    $questionID = $_POST['question_id'];
    $question = $_POST['question'];
    $questionType = $_POST['questionType'];
    $questionScore = $_POST['questionScore'];
    $questionAnswer = $_POST['questionAnswer'];
    $questionOption = $_POST['questionOption'];
    $insertAmount = $_POST['insertAmount'];
    $imageChanged = $_POST['imageChanged'];



    $marksQuery = "SELECT score, questions FROM quiz WHERE quiz_id = $quizID";

    $marksResult = mysqli_query($link, $marksQuery) or die(mysqli_error($link));

    $marksRow = mysqli_fetch_assoc($marksResult);

    if (!empty($marksRow)) {
        $quizMarks = $marksRow['score'];
    }

    $questionMarksQuery = "SELECT question_score FROM quiz_question WHERE question_id = $questionID";

    $questionMarksResult = mysqli_query($link, $questionMarksQuery) or die(mysqli_error($link));

    $questionMarksRow = mysqli_fetch_assoc($questionMarksResult);

    if (!empty($questionMarksRow)) {
        $currQMarks = $questionMarksRow['question_score'];
    }


    if ($currQMarks != $questionScore) {
        $quizMarks -= $currQMarks;
        $quizMarks += $questionScore;

        $updateQuizQuery = "UPDATE quiz SET score=$quizMarks WHERE quiz_id=$quizID";

        $updateQuizResult = mysqli_query($link, $updateQuizQuery) or die(mysqli_error($link));

        if ($updateQuizResult) {
            $isUpdated = true;
        }//end of update quiz
        else {
            $isUpdated = false;
        }
    }//end of different scores


    $updateQuizQuestionQuery = "UPDATE quiz_question SET question_type = '$questionType', question_score = $questionScore, question = '$question' WHERE question_id = $questionID";

    $updateQuizQuestionResult = mysqli_query($link, $updateQuizQuestionQuery) or die(mysqli_error($link));

    if ($updateQuizQuestionResult) {
        $isUpdated = true;
    }//end of update quiz question result
    else {
        $isUpdated = false;
    }



    $updateQuizAnswerQuery = "UPDATE quiz_answer SET answer = '$questionAnswer' WHERE question_id = $questionID";

    $updateQuizAnswerResult = mysqli_query($link, $updateQuizAnswerQuery) or die(mysqli_error($link));

    if ($updateQuizAnswerResult) {
        $isUpdated = true;
    }//end of update quiz answer result
    else {
        $isUpdated = false;
    }


    $deleteOptionsQuery = "DELETE FROM question_option WHERE question_id = $questionID";

    $deleteOptionsResult = mysqli_query($link, $deleteOptionsQuery) or die(mysqli_error($link));

    if ($deleteOptionsResult) {
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
    }//end of options deletion



    if ($imageChanged == "Yes") {
        $imageQuery = "SELECT name FROM question_image WHERE question_id ='$questionID'";

        $imageResult = mysqli_query($link, $imageQuery) or die(mysqli_error($link));

        while ($iRow = mysqli_fetch_assoc($imageResult)) {
            $images[] = $iRow['name'];
        }


        $deleteImagesQuery = "DELETE FROM question_image WHERE question_id = $questionID";
        $deleteImagesResult = mysqli_query($link, $deleteImagesQuery) or die(mysqli_error($link));

        if ($deleteImagesQuery) {
            $existingImgQuery = "SELECT name FROM question_image";

            $existingImgResult = mysqli_query($link, $existingImgQuery) or die(mysqli_error($link));

            while ($eIRow = mysqli_fetch_assoc($existingImgResult)) {
                $existingImgArr[] = $eIRow['name'];
            }

            $imagesToDelete = array_values(array_diff($images, $existingImgArr));
            if ($images[0] != "None" && count($imagesToDelete) != 0) {
                for ($i = 0; $i < count($imagesToDelete); $i++) {
                    $quizImgLocation = "../css/img/quizImg/quiz" . strval($quizID) . "/" . $imagesToDelete[$i];
                    unlink($quizImgLocation);
                }//end of images delete loop
            }
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
        }//end of delete images success
    }//end of image changed

    if ($isUpdated) {
        echo $quizID;
    }
}//end of POST validation
?>
