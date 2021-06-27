<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <Title>Logout</Title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="icon.png">
        <link rel="stylesheet" href="css/all.css">
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.typekit.net/dte4shr.css">
        <link rel="stylesheet" href="css/jquery-ui.min.css"> 
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="js/signin.js" type="text/javascript"></script>
        <script src="js/jquery.validate.min.js" type ="text/javascript"></script>
        <script src="additional-methods.min.js" type="text/javascript"></script>
        <style>
            body, html {
                height: 100%;
                margin: 0;
                background-image: url("loginBackgroundImage.png");

                /* Full height */
                height: 100%; 

                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;

                font-family: europa,sans-serif;
                font-weight: 400;
                font-style: normal;
            }
            .card{
                width: 400px;
                height: 300;
                justify-content: center;
                margin-top: 100px;
                margin-bottom: 100px;
                border-radius: 20px;
            }
            .container{
                display: flex;
                justify-content: center;
                flex-direction: row;
            }
            .card-img-top{
                height: 100%;
                width: 40%;
                margin-left: 20px;
                margin-top: 10px;
            }
            .card-title{
                margin-top: 10px;
                margin-left: 20px;
                text-align: left;
            }

            .card-link{
                color: grey;
                font-size: 15px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <form id="defaultForm">
                <div class="card">
                    <img class="card-img-top" src="css/img/histologie.png">
                    <h4 class="card-title">You've successfully signed out</h4>
                    <div class="card-body text-right">
                    </div>
                    <div style='text-align: center;'>
                        <a href="homepage.php" class="card-link">Click here to go to homepage</a>
                    </div>
                    <div style='text-align: center; margin-bottom: 10px'>
                        <a href="signinpage.php" class="card-link">Click here to sign in again</a>
                    </div>
                </div>
            </form>
        </div>


    </body>
</html>

