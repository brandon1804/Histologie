<?php

session_start();
$userID = $_SESSION['user_id'];

include "dbFunctions.php";


$quizzesCQuery = "SELECT COUNT(QT.user_quiz_id) AS 'quizzesC_count' FROM quiz_taken QT WHERE QT.user_id = $userID";
$passingRateQuery = "SELECT QT.user_score, Q.score FROM quiz_taken QT INNER JOIN quiz Q ON QT.quiz_id = Q.quiz_id WHERE QT.user_id = $userID";



$quizzesCResult = mysqli_query($link, $quizzesCQuery);
$passingResult = mysqli_query($link, $passingRateQuery);


$cRow = mysqli_fetch_assoc($quizzesCResult);



if (!empty($cRow)) {
    $quizzesC = $cRow['quizzesC_count'];
}

while ($pRow = mysqli_fetch_assoc($passingResult)) {
    $passRates[] = $pRow;
}


$content['quizzesC'] = $quizzesC;
$passCount = 0;
$asCount = 0;

for ($i = 0; $i < count($passRates); $i++) {
    $obj = ($passRates[$i]);
    $userScore = $obj['user_score'];
    $quizScore = $obj['score'];
    $percentage =  round(($userScore / $quizScore) * 100);
    if($percentage >= 50){
        $passCount += 1;
    }

}//end of for loop

for ($i = 0; $i < count($passRates); $i++) {
    $obj = ($passRates[$i]);
    $userScore = $obj['user_score'];
    $quizScore = $obj['score'];
    $percentage =  round(($userScore / $quizScore) * 100);
   
    $asCount += $percentage;
   
}//end of for loop

$passPercentage = round(($passCount / $quizzesC) * 100);
$content['passPercentage'] = strval($passPercentage);

$asPercentage = round(($asCount / $quizzesC));
$content['asPercentage'] = strval($asPercentage);


mysqli_close($link);

echo json_encode($content);
?>
