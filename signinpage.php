<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <Title>Login</Title>
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
                height: 390px;
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
                width: 30%;
                margin-left: 20px;
                margin-top: 10px;
            }
            .card-title{
                margin-top: 10px;
                margin-left: 20px;
                text-align: left;
            }
            .form-control{
                margin-bottom: 20px;
            }
            .btn{
                background-color: #E11E7A;
                margin-bottom: 20px;
                margin-left: 20px;
                margin-right: 20px;
                border-radius: 10px;
            }
            .btn:hover{
                background-color: #E11E7A;
            }
        </style>
    </head>
    <body>
        <div class="container">

            <form>
                <div class="card">
                    <img class="card-img-top" src="css/img/histologie.png">
                    <h4 class="card-title">Sign into your account</h4>
                    <div class="card-body text-center">
                        <h6 class="card-email text-left">Enter your email</h6>
                        <input type="text" class="form-control" name="email" id="idEmail" placeholder="Email Address" required autofocus>
                        <h6 class="card-password text-left">Enter your password</h6>
                        <input type="text" class="form-control" name="password" id="idPassword" placeholder="Password" required>
                        <a class="card-text text-right" href="passwordReset.php">Forget your password?</a>
                    </div>

                    <input type="submit" value="Login" class="btn btn-primary" id="loginBtn"/></br>
                </div>
            </form>
        </div>


    </body>
</html>

