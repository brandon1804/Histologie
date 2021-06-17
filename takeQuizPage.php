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
        <title>Quiz</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="icon.png">
        <link rel="stylesheet" href="css/all.css">
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.typekit.net/dte4shr.css">
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="js/additional-methods.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="js/takeQuiz.js" type="text/javascript"></script>
        <style type="text/css">
            body{
                font-family: europa,sans-serif;
                font-weight: 400;
                font-style: normal;
                padding-top: 100px; 
            }
            .row, .spinner-border{
                color: #E11A7A;
            }
      


        </style>
    </head>
    <body>
        <?php
        include("navbar.php");
        ?>
        <div class="container"> 
            <div class="row justify-content-between"> 
                <div class="col-6">
                    <h1 id="quizTitle"></h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <h1 id="quizTimer"></h1>
                </div>
            </div>
            <div class="progress" style="height: 8px;">
                <div class="progress-bar" role="progressbar" style="width: 0%; background-color: #E11A7A;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div id="questionContent">
                <br><button type="button" id = "nextBtn" class="btn btn-primary">Next Question</button>
            </div>
            <div class="modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" id="quiz_end_modal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Times Up!</h5>
                        </div>
                        <div class="modal-body text-center">
                            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                                <span class="sr-only">Loading...</span>
                            </div><br><br>
                            <p>You will be redirected to the results page shortly.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
