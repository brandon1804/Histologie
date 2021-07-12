<!DOCTYPE html>
<html>
    <head>
        <title>FAQ</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="icon.png">
        <link rel="stylesheet" href="css/all.css">
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.typekit.net/dte4shr.css">
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="js/additional-methods.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/faq.js" type="text/javascript"></script>
        <style>
            h1{
                text-align: center;
                margin-bottom: 40px;
                margin-top: 5rem;
                font-size: 2.5rem;
                color: white;
            }
            .main {
                width: 80%;
                margin: auto;
                position: relative;
                padding: 2%;
                padding-bottom: 10%;
            }

            body {  
                background-color: #E11E7A;
                font-family: europa,sans-serif;
            }

            .sec {
                font-size: 1.5vw;
                width: 110%;
                padding: 1.5%;
                cursor: pointer;
                margin-top: 10px;
                background-color: lightgray;
                text-align: left;
                color: black;
            }

            .sec:hover {
                width: 110%;
                padding: 2vw;
            }

            .fa {
                float: right
            }

            .collapsable {
                width: 110%;
                padding: 2%;
                font-size: 20px;
                display: none;
                color: black;
                background-color: white
            }
        </style>
    </head>
    <body>
        <?php
        session_start();
        include("navbar.php");
        ?>
        <h1>FAQ</h1>
        <div class="container">
            <div class="container main">
                <center>
                    <div class="accordian">
                        <div class="sec">
                            <span class="section">What is Histologie?</span> <i class="fa fa-plus right"></i>
                        </div>
                        <div id="colp1" class="collapsable">
                            Histologie is a web application that allows students to view lessons, and take quizzes. Students are also able to view images. 
                        </div>
                    </div>
                    
                    <div class="accordian">
                        <div class="sec">
                            <span class="section">What is Histologie?</span> <i class="fa fa-plus right"></i>
                        </div>
                        <div id="colp2" class="collapsable">
                            Histologie is a web application that allows students to view lessons, and take quizzes. Students are also able to view images. 
                        </div>
                    </div>
                    
                    <div class="accordian">
                        <div class="sec">
                            <span class="section">What is Histologie?</span> <i class="fa fa-plus right"></i>
                        </div>
                        <div id="colp3" class="collapsable">
                            Histologie is a web application that allows students to view lessons, and take quizzes. Students are also able to view images. 
                        </div>
                    </div>
                    
                    <div class="accordian">
                        <div class="sec">
                            <span class="section">What is Histologie?</span> <i class="fa fa-plus right"></i>
                        </div>
                        <div id="colp4" class="collapsable">
                            Histologie is a web application that allows students to view lessons, and take quizzes. Students are also able to view images. 
                        </div>
                    </div>
                </center>
            </div>
        </div>
    </body>
</html>