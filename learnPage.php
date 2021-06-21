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
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <style type="text/css">
            body{
                font-family: europa,sans-serif;
                font-weight: 400;
                font-style: normal;
                padding-top: 70px;
                margin-top: 20px;
            }
            .card-text{
                font-family: europa,sans-serif;
                font-weight: 700;
                font-style: normal;
            }
            .card{
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                border-radius: 20px;
                width: 20rem;
                height: 20rem;
                margin-right: 60px;
            }
            .card img{
                width: 20rem;
                height: 10rem;
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;
            }
            input[type=text]{
                float: right;
                padding: 6px;
                margin-top: 8px;
                margin-right: 16px;
                font-size: 17px;
                border: 1px solid #ccc;
            }
        </style>
    </head>
    <body>
        <?php
        session_start();
        include("navbar.php");
        ?>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-6">
                    <h1>Learn</h1>
                </div>
                <div class="col-6 d-flex justify-content-end align-items-center">
                    <select class="form-control w-50" id="idLessonCategory">
                        <option value="">Select Lesson Category</option>
                        <option value="tissue and cells">Tissues and cells</option>
                        <option value="recognising diseases">Recognising diseases</option>
                        <option value="tumours">Tumours</option>
                    </select>
                </div>
            </div>
            <div class="mt-5">
                <h4>Lessons:</h4>
                <div class="row">
                    <div class="column">
                        <div class="card">
                            <img class="card-img-top" src="img/lung.JPG" />
                            <div class="card-body">
                                <h5 class="card-text">Tissue and cell</h5>
                                <h6>A cell consists of three parts: the cell membrane, the nucleus, between the two, the cytoplasm. </h6>
                                <a href="quizResultPage.php" class="btn btn-primary">Start lesson</a>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card">
                            <img class="card-img-top" src="img/lung.JPG" />
                            <div class="card-body">
                                <h5 class="card-text">Recognising Diseases</h5>
                                <h6>In this lesson, you will try to identify tissues and try to identify the abnormality. </h6>
                                <a href="quizResultPage.php" class="btn btn-primary">Start lesson</a>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card">
                            <img class="card-img-top" src="img/lung.JPG" />
                            <div class="card-body">
                                <h5 class="card-text">Tumours</h5>
                                <h6>Tumours are groups of abnormal cells that forms lumps or growth. Tumours grow and behave differently. </h6>
                                <a href="quizResultPage.php" class="btn btn-primary">Start lesson</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
