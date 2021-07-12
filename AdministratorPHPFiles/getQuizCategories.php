<?php

include("dbFunctions.php");
$categoryQuery = "SELECT * FROM quiz_category";

$categoryResult = mysqli_query($link, $categoryQuery) or die(mysqli_error($link));


while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
    $quizCategories[] = $categoryRow['category_name'];
}

echo json_encode($quizCategories);
?>

