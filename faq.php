<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signinpage.php");
    exit();
}//end of session validation
?>
<!DOCTYPE html>
<html>
    <head>
        <title>FAQ</title>
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
        
        <link rel="stylesheet" href="./css/faq.css">
        <script src="./js/faq.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
//        session_start();
        include("navbar.php");
        ?>
        <h1>FAQ</h1>
        <div class="container">
            <div class="list-of-faq">
                
            </div>
        </div>
    </body>
</html>