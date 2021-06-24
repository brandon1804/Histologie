<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <Title>Reset Password</Title>
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
        <script src="js/jquery.validate.min.js" type ="text/javascript"></script>
        <script src="additional-methods.min.js" type="text/javascript"></script>
        <script src="js/resetPassword.js" type="text/javascript"></script>
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
                height: 300px;
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
                width: 40%;
                margin-left: 20px;
                margin-top: 10px;
            }
            .card-title{
                margin-top: 10px;
                margin-left: 20px;
                text-align: left;
            }
            .btn{
                background-color: #E11E7A;
                border-color: #E11E7A;
                margin-bottom: 10px;
                margin-left: 20px;
                margin-right: 20px;
                border-radius: 10px;
            }
            .btn:hover{
                background-color: #E11E7A;
                border-color: #E11E7A;
            }
            .card-link{
                align-self: center;
                margin-bottom: 15px;
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
                    <h4 class="card-title">Reset your password</h4>
                    <div class="card-body text-right">
                        <h6 class="card-email text-left">Enter your email</h6>
                        <input type="text" class="form-control" name="email" id="idEmail" placeholder="Email Address" required autofocus>
                    </div>

                    <input type="submit" value="Reset Password" class="btn btn-primary" id="pwResetBtn"/></br>
                    <a href="signinpage.php" class="card-link">Go back to login</a>
                </div>
            </form>
        </div>


    </body>
</html>