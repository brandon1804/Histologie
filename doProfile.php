<?php
session_start();
include("dbFunctions.php");

$id = $_SESSION['user_id'];

if(isset($_POST)){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    
    $query = "update user set name = '$name', email = '$email', password = sha1('$password') where user_id = $id";
    
    $status = mysqli_query($link, $query) or die(mysqli_error($link));
    
    if(status){
        $response["success"] = "1";
    }else{
        $response["success"] = "0";
    }
    echo json_encode($response);
}
?>


