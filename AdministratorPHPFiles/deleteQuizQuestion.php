<?php

include("dbFunctions.php");
if (isset($_GET['question_id']) && isset($_GET['quiz_id'])) {

    $id = $_GET['question_id'];
    $quizID = $_GET['quiz_id'];

    $numQuestionsQuery = "SELECT questions FROM quiz WHERE quiz_id = $quizID";

    $numQuestionsResult = mysqli_query($link, $numQuestionsQuery) or die(mysqli_error($link));

    $numQRow = mysqli_fetch_assoc($numQuestionsResult);

    if (!empty($numQRow)) {
        $quizNumOfQuestions = $numQRow['questions'];
    }

    if ($quizNumOfQuestions >= 2) {
        $response = false;

        $questionMarksquery = "SELECT question_score FROM quiz_question QQ WHERE QQ.question_id = $id";
        $qmResult = mysqli_query($link, $questionMarksquery);

        $qmRow = mysqli_fetch_assoc($qmResult);

        if (!empty($qmRow)) {
            $questionMark = $qmRow['question_score'];
        }

        $imageQuery = "SELECT name FROM question_image WHERE question_id ='$id'";

        $imageResult = mysqli_query($link, $imageQuery) or die(mysqli_error($link));

        while ($iRow = mysqli_fetch_assoc($imageResult)) {
            $images[] = $iRow['name'];
        }



        $query = "DELETE FROM quiz_question WHERE question_id ='$id'";

        $status = mysqli_query($link, $query) or die(mysqli_error($link));

        if ($status) {
            $existingImgQuery = "SELECT name FROM question_image QI INNER JOIN quiz_question QQ ON QI.question_id = QQ.question_id WHERE QQ.quiz_id = $quizID";

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

            $response = true;
            $marksQuery = "SELECT score, questions FROM quiz WHERE quiz_id = $quizID";

            $marksResult = mysqli_query($link, $marksQuery) or die(mysqli_error($link));

            $marksRow = mysqli_fetch_assoc($marksResult);

            if (!empty($marksRow)) {
                $quizMarks = $marksRow['score'];
                $quizQuestions = $marksRow['questions'];
            }


            $quizMarks -= $questionMark;
            $quizQuestions -= 1;

            $updateQuizQuery = "UPDATE quiz SET score=$quizMarks, questions=$quizQuestions WHERE quiz_id=$quizID";

            $quizUpdateResult = mysqli_query($link, $updateQuizQuery) or die(mysqli_error($link));

            if ($quizUpdateResult) {
                $response = true;
            }//end of update quiz result 
        }//end of deleted
    }//end of question number validation
    else {
        $response = false;
    }


    echo json_encode($response);
}//end of isset
?>