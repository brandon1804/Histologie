<?php

include("dbFunctions.php");

if (isset($_GET['quiz_id'])) {

    function deleteFolder($dir) {
        foreach (glob($dir . '/*') as $file) {
            if (is_dir($file))
                deleteAll($file);
            else
                unlink($file);
        }
        rmdir($dir);
    }

//end of deleteFolder

    $id = $_GET['quiz_id'];


    $imageQuery = "SELECT I.filename FROM image I WHERE I.quiz_id ='$id'";

    $imageResult = mysqli_query($link, $imageQuery) or die(mysqli_error($link));

    $iRow = mysqli_fetch_assoc($imageResult);

    if (!empty($iRow)) {
        $filename = $iRow['filename'];
    }


    $qImagesQuery = "SELECT COUNT(question_image_id) AS 'imageCount' FROM `question_image` QI INNER JOIN quiz_question QQ ON QI.question_id = QQ.question_id WHERE QQ.quiz_id = $id GROUP BY QQ.quiz_id";

    $qImagesResult = mysqli_query($link, $qImagesQuery) or die(mysqli_error($link));

    $qImageRow = mysqli_fetch_assoc($qImagesResult);

    if (!empty($iRow)) {
        $imageCount = $qImageRow['imageCount'];
        if ($imageCount >= 1) {
            $quizImgsLocation = "../css/img/quizImg/quiz" . $id;
            deleteFolder($quizImgsLocation);
        }//end of images validation
    }


    $quizCatQuery = "SELECT quizcategory_id FROM quiz WHERE quiz_id = $id";

    $quizCatResult = mysqli_query($link, $quizCatQuery) or die(mysqli_error($link));

    $quizCatRow = mysqli_fetch_assoc($quizCatResult);

    if (!empty($quizCatRow)) {
        $quizCategoryId = $quizCatRow['quizcategory_id'];
    }


    $quizzesQuery = "SELECT COUNT(Q.quiz_id) AS 'quizCount' FROM quiz Q INNER JOIN quiz_category QC ON Q.quizcategory_id = QC.quizcategory_id WHERE QC.quizcategory_id = $quizCategoryId GROUP BY QC.quizcategory_id";

    $quizzesResult = mysqli_query($link, $quizzesQuery) or die(mysqli_error($link));

    $quizzesRow = mysqli_fetch_assoc($quizzesResult);

    if (!empty($quizzesRow)) {
        $quizzesCount = $quizzesRow['quizCount'];
    }


    if ($quizzesCount <= 1) {
        $query = "DELETE FROM quiz_category WHERE quizcategory_id= $quizCategoryId";
    }//end of one quiz
    else if ($quizzesCount > 1) {
        $query = "DELETE FROM quiz WHERE quiz_id='$id'";
    }//end of more than one quiz


    $status = mysqli_query($link, $query) or die(mysqli_error($link));

    if ($status) {
        $existingImgQuery = "SELECT I.filename FROM image I WHERE I.quiz_id IS NOT NULL";

        $existingImgResult = mysqli_query($link, $existingImgQuery) or die(mysqli_error($link));

        while ($eIRow = mysqli_fetch_assoc($existingImgResult)) {
            $existingImgArr[] = $eIRow['filename'];
        }

        if (isset($existingImgArr)) {
            if (in_array($filename, $existingImgArr) == false) {
                $quizImgLocation = "../css/img/quizImg/" . $filename;
                unlink($quizImgLocation);
            }//end of image validation
        }//end of existingImgArr validation
        else {
            $quizImgLocation = "../css/img/quizImg/" . $filename;
            unlink($quizImgLocation);
        }

        $response["message"] = "Success";
    } else {
        $response["message"] = "Failed";
    }

    echo json_encode($response);
}//end of isset
