<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/Histologie/signinpage.php");
    exit();
}//end of user validation
$category_id = $_GET['category_id'];

include "dbFunctions.php";

$query = "SELECT * FROM image_category WHERE image_category_id = $category_id";
$result = mysqli_query($link, $query);
$return = array();

while ($row = mysqli_fetch_assoc($result)) {
$category_id = $row['image_category_id'];
$query_image = "SELECT * FROM image WHERE image_category_id = $category_id";
$result_image = mysqli_query($link, $query_image);
$return_img = array();
while($row2 = mysqli_fetch_assoc($result_image)) {
$return_img[] = $row2;
}
$row['images'] = $return_img;
$return[] = $row;
}

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Specimens</title>
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
        <script src="js/specimenImg.js" type="text/javascript"></script>
        <style type="text/css">

            body{
                font-family: europa,sans-serif;
                font-weight: 400;
                font-style: normal;
                background: #f4f4f4;
            }
            .banner {
                background: #E11A7A;
            }
        </style>  
    </head>
    <body>
        <?php
        include("navbar.php");
        ?>
        <div class="container-fluid">
            <div class="px-lg-5">

                <!-- For demo purpose -->
                <div class="row py-5">
                    <div class="col-lg-12 mx-auto">
                        <div class="text-white p-5 shadow-sm rounded banner">
                            <h1 class="display-4">
                                <?php 
                                echo $return[0]["name"];
                                ?>
                                </h1>
                        </div>
                    </div>
                </div>
                <!-- End -->

                <div class="row">
                    <!-- Gallery item -->
                    <?php
                    foreach ($return[0]["images"] as $i){
                        echo '<form class="col-xl-3 col-lg-4 col-md-6 mb-4"id="'.$i["image_id"].'" method="POST" action="selectedSpecimen.php">
                            <input name="imageurl" type="hidden" value="./css/img/homepageImg/'.$i["filename"].'"/>
                            <img src="./css/img/homepageImg/'.$i["filename"].'" alt="" class="img-fluid">
                    </form>';
                    }
                    ?>
                </div>
            </div>
    </body>
</html>
