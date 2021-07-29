<?php
include "dbFunctions.php";

$query = "SELECT * FROM frequent_ask_questions";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$return = array();

foreach ($result as $i) {
    $return[] = $i;
}

echo json_encode($return);
?>