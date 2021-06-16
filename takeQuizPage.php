<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/Histologie/signinpage.php");
    exit();
}//end of user validation
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Quizzes</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="icon.png">
        <link rel="stylesheet" href="css/all.css">
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.typekit.net/dte4shr.css">
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="js/takeQuiz.js" type="text/javascript"></script>
        <style type="text/css">
            body{
                font-family: europa,sans-serif;
                font-weight: 400;
                font-style: normal;
                padding-top: 100px;
            }

        </style>
    </head>
    <body>
        <?php
        include("navbar.php");
        ?>

    </body>
</html>
