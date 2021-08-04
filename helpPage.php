<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signinpage.php");
    exit();
}//end of user validation
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Help</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="icon.png">
        <link rel="stylesheet" href="css/all.css">
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.typekit.net/dte4shr.css">
        <link rel="stylesheet" href="css/progresscircle.css">
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://kit.fontawesome.com/95b700a8fe.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
        <style>
            body {
                font-family: europa,sans-serif;
                font-weight: 400;
                font-style: normal;
                padding-top: 100px; 
                background-color: hsla(331, 79%, 49%, 1);
            }
            .card{
                border-radius: 20px;
                border-color: #fff;
            }
        </style>
    </head>
    <body>
        <?php
        include("navbar.php");
        ?>
        <div class="container"> 
            <div class="justify-content-center">
                <div class="col-12 mt-5">
                    <div class="card shadow">
                        <div class="card-body">
                            <h1 class="card-title mb-4">FAQ</h1>
                            <a href="faq.php" class="btn btn-primary stretched-link">Questions & Answers</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <div class="card shadow">
                        <div class="card-body">
                            <h1 class="card-title mb-4">Sign In, Register & Reset Password Tutorial</h1>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/uuaNa-Jn2KM" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <div class="card shadow">
                        <div class="card-body">
                            <h1 class="card-title mb-4">Lesson Tutorial</h1>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/v87zVdEDrcg" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <div class="card shadow">
                        <div class="card-body">
                            <h1 class="card-title mb-4">Quiz Tutorial</h1>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/DCVJ1JVgW-w" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <div class="card shadow">
                        <div class="card-body">
                            <h1 class="card-title mb-4">Image Tutorial</h1>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/PTjnzedhzKU" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>