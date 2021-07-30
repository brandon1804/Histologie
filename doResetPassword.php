<?php

session_start();
include "dbFunctions.php";

$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];