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
        <style type="text/css">

            body{
                font-family: europa,sans-serif;
                font-weight: 400;
                font-style: normal;
                background-color: white;
            }
            .card-body{
                margin-bottom: -10px
            }
            #carouselMultiItemExample{
                margin-top: 40px;
            }
            .control-buttons{
                margin-top: 475px;
            }
            .carousel-control-prev{
                color: #E11E7A;
            }
            .carousel-control-next{
                color: #E11E7A;
            }
            .carousel-control-next-icon, .carousel-control-prev-icon{
                outline: black;
                background-size: 100%, 100%;
                border-radius: 50%;
                background-image: none;
            }

        </style>  
    </head>
    <body>
        <?php
        session_start();
        include("navbar.php");
        ?>
        <div class="container ">
            <!-- Carousel wrapper -->
            <div
                id="carouselMultiItemExample"
                class="carousel slide carousel-dark text-center"
                data-mdb-ride="carousel"
                >
                <!-- Inner -->
                <div class="carousel-inner py-4">
                    <!-- Single item -->
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card">
                                        <img
                                            src="https://mdbootstrap.com/img/new/standard/nature/181.jpg"
                                            class="card-img-top"
                                            alt="..."
                                            />
                                        <div class="card-body">
                                            <h5 class="card-title">Kidney</h5>
                                            <p class="card-text">
                                                The kidneys are two bean-shaped organs, each about the size of a fist. They are located just below the rib cage, one on each side of your spine. Healthy kidneys filter about a half cup of blood every minute, removing wastes and extra water to make urine.
                                            </p>
                                            <a href="#!" class="btn btn-primary">Button</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 d-none d-lg-block">
                                    <div class="card">
                                        <img
                                            src="https://mdbootstrap.com/img/new/standard/nature/182.jpg"
                                            class="card-img-top"
                                            alt="..."
                                            />
                                        <div class="card-body">
                                            <h5 class="card-title">Liver</h5>
                                            <p class="card-text">
                                                The liver is an organ about the size of a football. It sits just under your rib cage on the right side of your abdomen. The liver is essential for digesting food and ridding your body of toxic substances.
                                            </p>
                                            <a href="#!" class="btn btn-primary">Button</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 d-none d-lg-block">
                                    <div class="card">
                                        <img
                                            src="https://mdbootstrap.com/img/new/standard/nature/183.jpg"
                                            class="card-img-top"
                                            alt="..."
                                            />
                                        <div class="card-body">
                                            <h5 class="card-title">Lung</h5>
                                            <p class="card-text">
                                                The lungs are a pair of spongy, air-filled organs located on either side of the chest (thorax). The trachea (windpipe) conducts inhaled air into the lungs through its tubular branches, called bronchi.
                                            </p>
                                            <a href="#!" class="btn btn-primary">Button</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--- Inner -->
                    <!-- Controls -->
                    <div class="control-buttons d-flex justify-content-center mb-4">
                        <button
                            class="carousel-control-prev position-relative"
                            type="button"
                            data-mdb-target="#carouselMultiItemExample"
                            data-mdb-slide="prev"
                            >
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button
                            class="carousel-control-next position-relative"
                            type="button"
                            data-mdb-target="#carouselMultiItemExample"
                            data-mdb-slide="next"
                            >
                            <span class="visually-hidden">Next</span>
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
                <!-- Carousel wrapper -->
            </div>
    </body>
</html>