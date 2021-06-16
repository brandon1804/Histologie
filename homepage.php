
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Histologie</title>
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
        <link rel="stylesheet" href="css/gallery-grid.css">
        <script src="css/gallery-grid.css"></script>
        <style type="text/css">
            body{
                font-family: europa,sans-serif;
                font-weight: 400;
                font-style: normal;
            }
        </style>
    </head>
    <body>
        <?php
        session_start();
        include("navbar.php");
        ?>
        <div class="grid-container">
            <div class="tz-gallery">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <a class="lightbox" href="./css/img/homepageImg/capillary.jpg">
                            <img src="./css/img/homepageImg/capillary.jpg" alt="capillary">
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a class="lightbox" href="./css/img/homepageImg/cardiacmuscle.jpg">
                            <img src="./css/img/homepageImg/cardiacmuscle.jpg" alt="cardiacmuscle">
                        </a>
                    </div>
                    <div class="col-sm-12 col-lg-3">
                        <a class="lightbox" href="./css/img/homepageImg/collagenfibers.jpg">
                            <img src="./css/img/homepageImg/collagenfibers.jpg" alt="collagenfibers">
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a class="lightbox" href="./css/img/homepageImg/gallbladder.jpg">
                            <img src="./css/img/homepageImg/gallbladder.jpg" alt="gallbladder">
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a class="lightbox" href="./css/img/homepageImg/hepatocytes.jpg">
                            <img src="./css/img/homepageImg/hepatocytes.jpg" alt="hepatocytes">
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a class="lightbox" href="./css/img/homepageImg/interlobularduct.jpg">
                            <img src="./css/img/homepageImg/interlobularduct.jpg" alt="interlobularduct">
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a class="lightbox" href="./css/img/homepageImg/kupffercell.jpg">
                            <img src="./css/img/homepageImg/kupffercell.jpg" alt="kupffercell">
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a class="lightbox" href="./css/img/homepageImg/neuromuscularjunction.jpg">
                            <img src="./css/img/homepageImg/neuromuscularjunction.jpg" alt="neuromuscularjunction">
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a class="lightbox" href="./css/img/homepageImg/peripheralnerve.jpg">
                            <img src="./css/img/homepageImg/peripheralnerve.jpg" alt="peripheralnerve">
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a class="lightbox" href="./css/img/homepageImg/kupffercell.jpg">
                            <img src="./css/img/homepageImg/kupffercell.jpg" alt="kupffercell">
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a class="lightbox" href="./css/img/homepageImg/neuromuscularjunction.jpg">
                            <img src="./css/img/homepageImg/neuromuscularjunction.jpg" alt="neuromuscularjunction">
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a class="lightbox" href="./css/img/homepageImg/neuromuscularjunction.jpg">
                            <img src="./css/img/homepageImg/neuromuscularjunction.jpg" alt="neuromuscularjunction">
                        </a>
                    </div>
                </div>

            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
            <script>
                baguetteBox.run('.tz-gallery');
            </script>
    </body>
</html>
