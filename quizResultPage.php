<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signinpage.php");
    exit();
}//end of user validation

if (isset($_GET['quiz_id']) == false) {
    header("Location: quizzesPage.php");
    exit();
}//end of quiz id validation
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
                height: 10rem;
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;
            }
            #score{
                font-size: 100px;
            }


            @media (min-width: 576px) and (max-width: 1200px) { 
                #quizzesRow .card{
                    width: 22rem;
                }
            }
        </style>
    </head>
    <body>
        <?php
        include("navbar.php");
        ?>
        <div class="container"> 
            <div class="d-flex justify-content-center">
                <div class = "col-12" id="resultContent">
                    <div class="card shadow" style="border-color: #fff; border-radius: 20px;">
                        <div class="card-body">
                            <div id="result">
                                <div class="row justify-content-between"> 
                                    <div class="col-6">
                                        <h1 id="quizTitle"></h1>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end align-items-center">     
                                        <div id="shareBlock" class="mr-2"></div>

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
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-danger" id="generatePDF"><i class="fas fa-file-pdf mr-2"></i>Download Certificate</button>
                            </div>
                            <h1 class="mt-5 mb-4">Questions</h1>
                            <div class="card shadow mb-5" style="border-color: #fff; border-radius: 20px;">
                                <div class="table-responsive">
                                    <table id="questionsTable" class="table table-borderless" cellspacing="0" width="100%">
                                        <thead style="background-color: #fafafa;">
                                            <tr>
                                                <th>Question</th>
                                                <th>Your Answer</th>
                                                <th>Answer</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table> 
                                </div>
                            </div>
                            <h1 class="mb-4">More Quizzes</h1>
                            <div id="quizzesRow" class="row flex-row">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>