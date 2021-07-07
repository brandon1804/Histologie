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
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Quiz Result</title>
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
        <script src="js/progresscircle.js"></script>
        <script src="js/jquery.c-share.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
        <script src="js/quizResult.js"></script>
        <style>
            body {
                font-family: europa,sans-serif;
                font-weight: 400;
                font-style: normal;
                padding-top: 100px; 
                background-color: hsla(331, 79%, 49%, 1);
            }

            .circlechart {
                float: left;
                padding: 30px;
            }

            .row{
                border-radius: 5px;
            }

            .card-text{
                font-family: europa,sans-serif;
                font-weight: 700;
                font-style: normal;
            }
            .card{
                border-radius: 20px;
            }
            .card img{
                width: 20rem;
                height: 10rem;
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;
            }
            #score{
                font-size: 100px;
            }
            #resultContent{
                background-color:white;
                padding: 30px;
                border-radius: 20px;
            }
            .btn-circle {
                width: 45px;
                height: 45px;
                line-height: 45px;
                text-align: center;
                padding: 0;
                border-radius: 50%;
            }

            .btn-circle i {
                position: relative;
                top: -1px;
            }

            .btn-circle-sm {
                width: 30px;
                height: 30px;
                line-height: 30px;
                font-size: 0.8rem; 
            }

        </style>
    </head>
    <body>
        <?php
        include("navbar.php");
        ?>
        <div class="container"> 
            <div class="d-flex justify-content-center">
                <div id="resultContent">
                    <div id="result">
                        <div class="row justify-content-between"> 
                            <div class="col-6">
                                <h1 id="quizTitle"></h1>
                            </div>
                            <div class="col-6 d-flex justify-content-end align-items-center">     
                                <div id="shareBlock" class="mr-2"></div>
                                <button class="btn btn-danger btn-circle btn-circle-sm m-1" id="generatePDF"  title="Share as PDF"><i class="fas fa-file-pdf"></i></button>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-sm-12 col-xl-6 border-right">
                                <div class="d-flex justify-content-center">
                                    <div class="circlechart" data-percentage="0"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xl-6 d-flex align-items-center justify-content-center">

                                <text id="score"></text>
                            </div>
                        </div>
                    </div>
                    <h1 class="mb-2">More Quizzes</h1>
                    <div id="quizzesRow" class="row flex-row">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>