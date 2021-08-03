<?php
session_start();

include("dbFunctions.php");

//if (!isset($_SESSION['user_id'])) {
//    header("Location: signinpage.php");
//    exit();
//}//end of user validation
//else {
    $imgCategories = array();
    $query = "SELECT * FROM image_category";
    $result = mysqli_query($link, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $imgCategories[] = $row;
    }
//}//end of else

mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Learn</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="icon.png">
        <link rel="stylesheet" href="css/all.css">
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.typekit.net/dte4shr.css">
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/imgCat.js" type="text/javascript"></script>
        <style type="text/css">
            body{
                font-family: europa,sans-serif;
                font-weight: 400;
                font-style: normal;
                padding-top: 70px;
                margin-top: 20px;
            }
            .card img{
                width: 20rem;
                height: 10rem;
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;
            }
            .card{
                border-radius: 20px;
                width: 20rem;
                height: 300px;
            }
            #imgRow{
                padding-top: 10px;
                padding-bottom: 10px;
            }
            card-body{
                margin-right: 10px;
                margin-left: 10px;
                font-size: 13px;
                margin-bottom: 10px;
            }
            card-subtitle{
                margin-right: 10px;
                margin-left: 10px;
                font-size: 13px;
                margin-bottom: 10px;
            }

            .card-title2{
                margin-left: 10px;
                margin-top: 20px;
            }

            .card-body2{
                align-content: center;
                justify-content: center;
            }
            .card-title3{
                margin-left: 10px;
                margin-top: 20px;
            }
            .card-subtitle3{
                margin-left: 10px;
            }
            .btn{
                margin-top: 10px;
            }
            .card-img-top{
                width: 20rem;
                height: 10rem;
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;
            }
        </style>
    </head>
    <body>
        <?php
        include("navbar.php");
        ?>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-6">
                    <h1>Images</h1>
                </div>
                </br>
            </div>
            <div id="imgRow" class="row d-flex flex-row flex-nowrap overflow-auto">
            </div><br><br>
        </div>
    </body>
</html>