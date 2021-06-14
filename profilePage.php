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
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <style type="text/css">
            body{
                font-family: europa,sans-serif;
                font-weight: 400;
                font-style: normal;
                background-color: #E11A7A;
            }
            .card{
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                height: 400px;
                width: 530px;
                border-radius: 20px;
                margin-top: 150px;
                margin-bottom: 20px;
            }
            .card-title{
                font-size: 25px;
                font-style: normal;
                margin-top: 10px;
            }
            .card-text{
                margin-top: 10px;
            }
            .btn-primary{
                margin-left: 20px;
                margin-right: 20px;
                background-color: #008000;
            }
            .container{
                display: flex;
                justify-content: center;
                flex-direction: row;
            }
            .btn:hover{
                background-color: #008000;
            }
        </style>
    </head>
    <body>
        <?php
        session_start();
        include("navbar.php");
        ?>
        <div class="container ">
            <form method="post" action="doProfile.php">
                <div class="card">
                    <h4 class="card-title text-center">Edit profile</h4>
                    <div class="card-body text-center">
                        <h6 class="card-text text-left">Name</h6>
                        <input type="text" class="form-control" name="name" placeholder="Update new name" required>
                        <h6 class="card-text text-left">Email</h6>
                        <input type="text" class="form-control" name="email" placeholder="Update new email" required>
                        <h6 class="card-text text-left">Password</h6>
                        <input type="text" class="form-control" name="password" placeholder="Update new password" required>
                    </div>
                    
                    <input type="submit" value="Done" class="btn btn-primary"/></br>
                </div>
            </form>
        </div>
    </body>
</html>
