<?php
session_start();
include "dbFunctions.php";

$userID = $_SESSION['user_id'];


$query = "SELECT QT.quiz_taken_date, Q.title, QT.user_score, Q.score FROM quiz_taken QT INNER JOIN quiz Q ON QT.quiz_id = Q.quiz_id WHERE QT.user_id = $userID";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_assoc($result)) {
     $quizHistory[] = $row;
}
mysqli_close($link);

echo json_encode($quizHistory);

?>
