<?php

include "dbFunctions.php";

$query = "";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $lesson[] = $row;
}
mysqli_close($link);

echo json_encode($lesson);
?>

