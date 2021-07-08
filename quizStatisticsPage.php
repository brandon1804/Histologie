<?php
session_start();
include("dbFunctions.php");
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/Histologie/signinpage.php");
    exit();
}//end of session validation

if (isset($_SESSION['user_id']) && isset($_SESSION['account_type'])) {
    $accountType = $_SESSION['account_type'];
    if ($accountType !== "staff") {
        header("Location: http://localhost/Histologie/accessDeniedPage.php");
        exit();
    }
}//end of account type validation

$id = $_GET['id'];
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Quiz Statistics</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="icon.png">
        <link rel="stylesheet" href="css/all.css">
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/quizStatistics.css">
        <link rel="stylesheet" href="css/progresscircle.css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://use.typekit.net/dte4shr.css">
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="js/additional-methods.min.js" type="text/javascript"></script>
        <script src="js/progresscircle.js"></script>
        <script src="js/quizStatistics.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <a href="dashboard.php"><img src="./css/img/histologie.png" alt="logo" style="width: 120px"></a>
                </div>

                <ul class="list-unstyled components">
                    <li>
                        <a class="d-flex align-items-center" href="dashboard.php"><i class='bx bx-grid-alt bx-sm mr-2'></i>Dashboard</a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="manageStudents.php"><i class='bx bx-user bx-sm mr-2'></i>Students</a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="#"><i class='bx bx-sm bx-image mr-2'></i>Images</a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="#"><i class='bx bx-sm bx-book-open mr-2'></i>Lessons</a>
                    </li>
                    <li class="active">
                        <a class="d-flex align-items-center" href="manageQuizzes.php"><i class='bx bx-sm bxs-edit mr-2' ></i>Quizzes</a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="#"><i class='bx bx-sm bx-info-circle mr-2' ></i>FAQ</a>
                    </li>
                </ul>

                <ul class="list-unstyled CTAs">
                    <li>
                        <a href="doLogout.php" class="signout d-flex align-items-center justify-content-center" style=" background: #E11A7A;
                           color: #FFF;"><i class='bx bx-log-out bx-sm mr-1'></i>Sign Out</a>
                    </li>
                </ul>
            </nav

            <!-- Page Content  -->
            <div id="content">
                <i id="sidebarCollapse" class='bx bx-sm bx-menu' style="color:#E11A7A"></i>
                <div class="container">
                    <div class="row justify-content-between mb-4"> 
                        <div class="col-6">
                            <h1 id="quizTitle"></h1>
                        </div>
                        <div class="col-6 d-flex justify-content-end align-items-center">
                            <a class="btn btn-primary d-flex align-items-center" href="managequizPage.php?id=<?php echo $id ?>" role="button"><i class='bx bx-sm bx-pencil mr-1'></i>Manage Quiz</a>
                        </div>
                    </div>
                    <div id="infoRow" class="row">
                        <div class="col-xl-4 col-sm-6 col-12 mb-3">
                            <div class="card shadow" style="border-color: #fff; height: 320px;">
                                <div class="card-body">
                                    <h3 class="card-title">Completion Rate</h3>  
                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                        <div class="circlechartSC" data-percentage="0"></div>
                                    </div>
                                    <p id="scText" class="card-text"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12 mb-3">
                            <div class="card shadow" style="border-color: #fff; height: 320px;">
                                <div class="card-body">
                                    <h3 class="card-title">Average Score</h3>
                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                        <div class="circlechartAS" data-percentage="0"></div>
                                    </div>
                                    <p id="asText" class="card-text"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12 mb-3">
                            <div class="card shadow" style="border-color: #fff; height: 320px;">
                                <div class="card-body"> 
                                    <h3 class="card-title">Top Scorer</h3>
                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                        <div class="circlechartTS" data-percentage="0"></div>
                                    </div>
                                    <p id="tsText" class="card-text"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-4 mb-4">Student Ranking</h1>
                    <div class="card shadow" style="border-color: #fff;">
                        <div class="table-responsive">
                            <table id="rankingTable" class="table table-borderless" cellspacing="0" width="100%">
                                <thead style="background-color: #fafafa;">
                                    <tr>
                                        <th>Rank</th>
                                        <th>Student</th>
                                        <th>Score</th>
                                        <th>Date</th> 
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table> 
                        </div>
                    </div>


                </div>
            </div>
    </body>
</html>
