<?php

include "dbFunctions.php"; 


$query = "SELECT U.name, U.student_id, U.email, U.account_type FROM user U ORDER BY U.student_id"; 
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $student[] = $row;
}
mysqli_close($link);

echo json_encode($student);
?>
