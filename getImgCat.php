<?php

include "dbFunctions.php";

$query = "SELECT * FROM image";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $imgCat[] = $row;
}
mysqli_close($link);

echo json_encode($imgCat);
?>

