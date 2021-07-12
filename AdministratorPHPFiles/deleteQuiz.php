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
        $quizImgLocation = "../css/img/quizImg/" . $filename;
        unlink($quizImgLocation);
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


    $query = "DELETE FROM quiz WHERE quiz_id='$id'";


    $status = mysqli_query($link, $query) or die(mysqli_error($link));

    if ($status) {
        $response["message"] = "Success";
    } else {
        $response["message"] = "Failed";
    }
    echo json_encode($response);
}
