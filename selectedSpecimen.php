<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/Histologie/signinpage.php");
    exit();
}//end of user validation

$imageurl = $_POST['imageurl'];
?>

<html>
    <head>
        <title>Images</title>
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
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <script src="js/zoomFunction.js" type="text/javascript"></script>
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
            img{
                width: 100%;
            }
            .imageContainer{
                overflow: auto;
                width: 100%;
                height: 100%;
            }
            .container-fluid{
                margin-top: 100px;
            }
            #image-control{
                width: 100%;
                height: 30px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 20px 10px;
                position: fixed;
                bottom: 0;
                left: 0;
            }
            i{
                width: 48px;
            }
        </style>  
    </head>
    <body>
        <?php
        include("navbar.php");
        ?>
        <div class="container-fluid">
            <div class="px-lg-5">
                <div id="imageContainer">
                    <img src="<?php echo $imageurl ?>"/>
                </div>
                <div id="image-control">
                    <i id="minus"class='bx bx-minus fs-2' ></i>
                    <input type="range" min="100" max="3000" value="100" class="form-range w-100" id="myRange">
                    <i id="plus"class='bx bx-plus fs-2'></i>
                </div>
            </div>
        </div>
    </body>
</html>
