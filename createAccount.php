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
        <script src="js/signup.js" type="text/javascript"></script>
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
                width: 450px;
                height: 600px;
                justify-content: center;
                margin-top: 50px;
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
                margin-top: 20px;
                margin-left: 20px;
                text-align: left;
            }
            #idEmail{
                margin-bottom: 20px;
            }
            #idName{
                margin-bottom: 20px;
            }
            #idPassword{
                margin-bottom: 20px;
            }
            .radioButton{
                margin-bottom: 20px;
            }
            .btn{
                background-color: #E11E7A;
                border-color: #E11E7A;
                margin-left: 20px;
                margin-bottom: 5px;
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
            <form>
                <div class="card">
                    <img class="card-img-top" src="css/img/histologie.png">
                    <h4 class="card-title">Create an account</h4>
                    <div class="card-body text-left">
                        <h6 class="card-name text-left">Name</h6>
                        <input type="text" class="form-control" name="name" id="idName" placeholder="Name" required autofocus>
                        <h6 class="card-email text-left">Email</h6>
                        <input type="text" class="form-control" name="email" id="idEmail" placeholder="Email Address" required>
                        <h6 class="card-password text-left">Password</h6>
                        <input type="text" class="form-control" name="password" id="idPassword" placeholder="Password" required> 
                        <input type="radio" id="staff" name="staffORstudent" value="staff" class="radioButton" checked="checked">
                        <label for="staff">Staff</label>
                        <input type="radio" id="student" name="staffORstudent" value="student" class="radioButton">
                        <label for="student">Student</label>
                        <h6 class="card-id text-left">Staff / Student ID</h6>
                        <input type="text" class="form-control" name="id" id="id" placeholder="ID" required>
                    </div>

                    <input type="submit" value="Sign up" class="btn btn-primary" id="signupBtn"/></br>
                    <a href="signinpage.php" class="card-link">Already have an account?</a>
                </div>
            </form>
        </div>


    </body>
</html>

