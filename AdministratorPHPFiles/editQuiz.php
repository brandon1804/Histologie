<?php

include("dbFunctions.php");

if (isset($_POST)) {

    $isUpdated = false;


    // update quiz variables
    $quizID = $_POST['quiz_id'];
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $timeLimit = $_POST['timeLimit'];
    $quizCategory = $_POST['quizCategory'];
    $categoryYN = $_POST['categoryYN'];
    $imageChanged = $_POST['imageChanged'];



    if ($categoryYN == "No") {
        $insertCategoryQuery = "INSERT INTO quiz_category(category_name) VALUES ('$quizCategory')";

        $categoryInsertResult = mysqli_query($link, $insertCategoryQuery) or die(mysqli_error($link));

        if ($categoryInsertResult) {
            $isUpdated = true;
        }//end of insert quiz result


        $catIDQuery = "SELECT MAX(quizcategory_id) AS 'catID' FROM quiz_category";

        $catIDResult = mysqli_query($link, $catIDQuery) or die(mysqli_error($link));

        $catIDRow = mysqli_fetch_assoc($catIDResult);

        if (!empty($catIDRow)) {
            $quizCategory = $catIDRow['catID'];
        }
    }//end of custom category



    $updateQuizQuery = "UPDATE quiz SET quizcategory_id=$quizCategory, duration='$timeLimit', title='$title', summary='$summary' WHERE quiz_id=$quizID";

    $quizUpdateResult = mysqli_query($link, $updateQuizQuery) or die(mysqli_error($link));

    if ($quizUpdateResult) {
        $isUpdated = true;
    }//end of update quiz result


    if ($imageChanged == "Yes") {
        $imageQuery = "SELECT I.filename FROM image I WHERE I.quiz_id ='$quizID'";

        $imageResult = mysqli_query($link, $imageQuery) or die(mysqli_error($link));

        $iRow = mysqli_fetch_assoc($imageResult);

        if (!empty($iRow)) {
            $dfilename = $iRow['filename'];
        }



        $filename = $_FILES["quizImage"]["name"];
        $tempname = $_FILES["quizImage"]["tmp_name"];
        $upload_location = "../css/img/quizImg/";
        $completePath = $upload_location . $filename;
        $imageName = pathinfo($filename)['filename'];


        $updateQuizImageQuery = "UPDATE image SET filename = '$filename', name='$imageName' WHERE quiz_id=$quizID";

        $quizImageUpdateResult = mysqli_query($link, $updateQuizImageQuery) or die(mysqli_error($link));

        if ($quizImageUpdateResult) {
            if (move_uploaded_file($tempname, $completePath)) {
                $existingImgQuery = "SELECT I.filename FROM image I WHERE I.quiz_id IS NOT NULL";

                $existingImgResult = mysqli_query($link, $existingImgQuery) or die(mysqli_error($link));

                while ($eIRow = mysqli_fetch_assoc($existingImgResult)) {
                    $existingImgArr[] = $eIRow['filename'];
                }

                if (in_array($dfilename, $existingImgArr) == false) {
                    $quizdImgLocation = "../css/img/quizImg/" . $dfilename;
                    unlink($quizdImgLocation);
                }//end of image validation
                $isUpdated = true;
            } else {
                $isUpdated = false;
            }
        }//end of result validation
    }//end of image changed


    echo $isUpdated;
}//end of POST validation
?>
