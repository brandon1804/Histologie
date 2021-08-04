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
        <script src="js/newPassword.js" type="text/javascript"></script>
        <script src="js/jquery.validate.min.js" type ="text/javascript"></script>
        <script src="additional-methods.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function(){
                
                $("#defaultForm").validate({
                    rules: {
                        newPassword: {
                            required: true,
                            pattern: /^[A-Za-z\d]{6,8}$/
                        },
                        confirmPassword: {
                            required: true,
                            pattern: /^[A-Za-z\d]{6,8}$/, 
                            equalTo: newPassword
                        }
                    }, 
                    messages: {
                        newPassword: {
                            required: "Please enter new password",
                            pattern: "Password must be 6 to 8 character long"
                        }
                    },
                    
                    submitHandler: function(){
                        return true;
                    }
                });
            });
        </script>
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
                height: 375px;
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
            .form-control{
                margin-bottom: 10px;
            }
            .btn{
                background-color: #E11E7A;
                border-color: #E11E7A;
                margin-bottom: 30px;
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
                        <h6 class="card-new-password text-left">Enter new password</h6>
                        <input type="password" class="form-control" name="newPassword" id="idNewPassword" placeholder="New Password" required autofocus>
                        <h6 class="card-confirm-password text-left">Confirm password</h6>
                        <input type="password" class="form-control" name="confirmPassword" id="idConfirmPassword" placeholder="Confirm Password" required>
                    </div>

                    <input type="submit" value="Reset Password" class="btn btn-primary" id="pwResetBtn"/>
                </div>
            </form>
        </div>


    </body>
</html>