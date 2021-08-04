<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signinpage.php");
    exit();
}//end of session validation

if (isset($_SESSION['user_id']) && isset($_SESSION['account_type'])) {
    $accountType = $_SESSION['account_type'];
    if ($accountType !== "staff") {
        header("Location: accessDeniedPage.php");
        exit();
    }
}//end of account type validation
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
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/profile.js" type="text/javascript"></script>
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
    </head>
    <body>
        <?php
        session_start();
        include("navbar.php");
        ?>
        <div class="container ">



            <div class="col-12">
                <div class="card shadow" style="border-color: white; border-radius: 10px">
                    <div class="card-body">
                        <h1 class="card-title mb-4">Edit Profile</h1>
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
                </div>
            </div>

        </div>
    </body>
</html>
