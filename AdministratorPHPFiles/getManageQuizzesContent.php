<?php

include "dbFunctions.php";



$quizzesAQuery = "SELECT COUNT(Q.quiz_id) AS 'quizzesA_count' FROM quiz Q";
$quizzesCQuery = "SELECT COUNT(QT.user_quiz_id) AS 'quizzesC_count' FROM quiz_taken QT";
$passingRateQuery = "SELECT QT.user_score, Q.score FROM quiz_taken QT INNER JOIN quiz Q ON QT.quiz_id = Q.quiz_id";


$quizzesAResult = mysqli_query($link, $quizzesAQuery);
$quizzesCResult = mysqli_query($link, $quizzesCQuery);
$passingResult = mysqli_query($link, $passingRateQuery);

$aRow = mysqli_fetch_assoc($quizzesAResult);
$cRow = mysqli_fetch_assoc($quizzesCResult);


if (!empty($aRow)) {
    $quizzesA = $aRow['quizzesA_count'];
}
if (!empty($cRow)) {
    $quizzesC = $cRow['quizzesC_count'];
}

while ($pRow = mysqli_fetch_assoc($passingResult)) {
    $passRates[] = $pRow;
}

$content['quizzesA'] = $quizzesA;
$content['quizzesC'] = $quizzesC;
$passCount = 0;

for ($i = 0; $i < count($passRates); $i++) {
    $obj = ($passRates[$i]);
    $userScore = $obj['user_score'];
    $quizScore = $obj['score'];
    $percentage =  round(($userScore / $quizScore) * 100);
    if($percentage >= 50){
        $passCount += 1;
    }

}//end of for loop

$passPercentage = round(($passCount / $quizzesC) * 100);
$content['passPercentage'] = strval($passPercentage);


mysqli_close($link);

echo json_encode($content);
?>
