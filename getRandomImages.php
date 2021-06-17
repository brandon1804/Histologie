<?php

include "dbFunctions.php";

$query = "SELECT name FROM image ORDER BY RAND() LIMIT 12";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $images[] = $row["name"];
}
mysqli_close($link);

echo json_encode($images);
?>
