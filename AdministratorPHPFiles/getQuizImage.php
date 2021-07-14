<?php
include("dbFunctions.php");

$id = $_GET['quiz_id'];


$imageQuery = "SELECT I.filename FROM image I WHERE I.quiz_id ='$id'";

$imageResult = mysqli_query($link, $imageQuery) or die(mysqli_error($link));

$iRow = mysqli_fetch_assoc($imageResult);

if (!empty($iRow)) {
    $filename = $iRow['filename'];
}


?>

