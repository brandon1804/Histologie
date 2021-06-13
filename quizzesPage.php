<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Quizzes</title>
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
        <script src="js/quizzes.js" type="text/javascript"></script>
        <style type="text/css">
            body{
                font-family: europa,sans-serif;
                font-weight: 400;
                font-style: normal;
                padding-top: 70px;
            }

            .card-text{
                font-family: europa,sans-serif;
                font-weight: 700;
                font-style: normal;
            }
            .card{
                border-radius: 20px;
            }
            .card img{
                width: 20rem;
                height: 10rem;
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;
            }
            #quizzesRow{
                padding-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <?php
        include("navbar.php");
        ?>
        <div class="container">
            <h1>Quizzes</h1>
            <div id="quizzesRow" class="row d-flex flex-row flex-nowrap overflow-auto">

            </div><br><br>

            <h1>Quiz History</h1>
            <table id="quizHistoryTable" class="table table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr><th>Date</th>
                        <th>Quiz Title</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

        </div>
    </body>
</html>

