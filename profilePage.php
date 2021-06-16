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
        <title>Profile</title>
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
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <style type="text/css">
            form .error {
                color: #ff0000;
            }
            body{
                font-family: europa,sans-serif;
                font-weight: 400;
                font-style: normal;
                background-color: white;
            }
            .btn{
                background-color: #149738;
            }
            .btn:hover{
                background-color: #149738;
                border-color: #E11E7A;
            }
            .container{
                margin-top: 80px;
            }
            .title{
                text-align: center;
            }
            .label{
                color: black;
            }
        </style>
        <script>
            $(document).ready(function(){
                
                $("#defaultForm").validate({
                    rules: {
                        name: {
                            required: true,
                            pattern: /^[a-zA-Z]* $/
                        },
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
                        name: {
                            required: "Please enter new name",
                            pattern: "Name must contain only alphabet"
                        },
                        email: {
                            required: "Please enter new email",
                            pattern: "Please enter a valid email"
                        },
                        password: {
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
    </head>
    <body>
        <?php
        session_start();
        include("navbar.php");
        ?>
         <div class="container ">
            <h3 class="title">Edit Profile</h3></br></br>
            
            <form id="defaultForm">
                <div class="form-group">
                    <label class="label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Update new name" required />
                </div>
                <div class="form-group">
                    <label class="label">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Update new email" required />
                </div>
                <div class="form-group">
                    <label class="label">Password</label>
                    <input type="text" class="form-control" name="password" placeholder="Update new password" required />
                </div>
                </br></br>
                <input type="submit" value="Done" class="btn btn-primary btn-block"/>
            </form>
        </div>
    </body>
</html>
