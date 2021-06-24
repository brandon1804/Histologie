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
        <script src="js/jquery.validate.min.js" type ="text/javascript"></script>
        <script src="additional-methods.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {

                $("#defaultForm").validate({
                    rules: {
                        email: {
                            required: true,
                            pattern: /^(\w+[\-\.])*\w+@(\w+\.)+[A-Za-z]+$/
                        },
                        password: {
                            required: true,
                            pattern: /^[A-Za-z\d]{6,8}$/
                        }
                    },
                    messages: {
                        email: {
                            required: "Please enter new email",
                            pattern: "Please enter a valid email"
                        },
                        password: {
                            required: "Please enter new password",
                            pattern: "Password must be 6 to 8 character long"
                        }
                    },

                    submitHandler: function () {
                        return true;
                    }
                });
            });
        </script>
        <style>
            form .error{
                color: #ff0000;
            }
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
                height: 410px;
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
            #idEmail{
                margin-bottom: 20px;
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
                color: grey;
                font-size: 15px;
                margin-bottom: 10px;
            }
            .modal-confirm {		
                color: #636363;
                width: 325px;
                font-size: 14px;
            }
            .modal-confirm .modal-content {
                padding: 20px;
                border-radius: 5px;
                border: none;
            }
            .modal-confirm .modal-header {
                border-bottom: none;   
                position: relative;
            }
            .modal-confirm h4 {
                text-align: center;
                font-size: 26px;
                margin: 30px 0 -15px;
            }
            .modal-confirm .form-control, .modal-confirm .btn {
                min-height: 40px;
                border-radius: 3px; 
            }
            .modal-confirm .close {
                position: absolute;
                top: -5px;
                right: -5px;
            }	
            .modal-confirm .modal-footer {
                border: none;
                text-align: center;
                border-radius: 5px;
                font-size: 13px;
            }	
            .modal-confirm .icon-box {
                color: #fff;		
                position: absolute;
                margin: 0 auto;
                left: 0;
                right: 0;
                top: -70px;
                width: 95px;
                height: 95px;
                border-radius: 50%;
                z-index: 9;
                background: #82ce34;
                padding: 15px;
                text-align: center;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
            }
            .modal-confirm .icon-box i {
                font-size: 58px;
                position: relative;
                top: 3px;
            }
            .modal-confirm.modal-dialog {
                margin-top: 80px;
            }
            .modal-confirm .btn {
                color: #fff;
                border-radius: 4px;
                background: #82ce34;
                text-decoration: none;
                transition: all 0.4s;
                line-height: normal;
                border: none;
            }
            .modal-confirm .btn:hover, .modal-confirm .btn:focus {
                background: #6fb32b;
                outline: none;
            }
            .trigger-btn {
                display: inline-block;
                margin: 100px auto;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <form id="defaultForm">
                <div class="card">
                    <img class="card-img-top" src="css/img/histologie.png">
                    <h4 class="card-title">Sign into your account</h4>
                    <div class="card-body text-right">
                        <h6 class="card-email text-left">Enter your email</h6>
                        <input type="text" class="form-control" name="email" id="idEmail" placeholder="Email Address" required autofocus>
                        <h6 class="card-password text-left">Enter your password</h6>
                        <input type="text" class="form-control" name="password" id="idPassword" placeholder="Password" required> 
                        <a href="passwordReset.php" class="card-link-password">Forgot your password?</a>
                    </div>

                    <input type="submit" value="Login" class="btn btn-primary" id="loginBtn"/></br>
                    <a href="createAccount.php" id="AA" class="card-link">Don't have an account?</a>
                </div>

            </form>

        </div>
        <div id="signinSuccessModal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box">
                            <i class="material-icons">&#xE876;</i>
                        </div>				
                        <h4 class="modal-title w-100">Awesome!</h4>	
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Your booking has been confirmed. Check your email for detials.</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
    </body>
</html>

