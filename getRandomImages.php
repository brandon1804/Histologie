<?php

include "dbFunctions.php";

$query = "SELECT filename,name FROM image ORDER BY RAND() LIMIT 12";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $images[] = ['filename' => $row['filename'], 'name' => $row['name']];
}
mysqli_close($link);

echo json_encode($images);
?>
