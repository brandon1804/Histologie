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
        <title>Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="icon.png">
        <link rel="stylesheet" href="css/all.css">
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/dashboard.css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://use.typekit.net/dte4shr.css">
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="js/additional-methods.min.js" type="text/javascript"></script>
        <script src="js/dashboard.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <a href="dashboard.php"><img src="./css/img/histologie.png" alt="logo" style="width: 120px"></a>
                </div>

                <ul class="list-unstyled components">
                    <li class="active">
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
                    <li>
                        <a class="d-flex align-items-center" href="manageQuizzes.php"><i class='bx bx-sm bxs-edit mr-2' ></i>Quizzes</a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="manageFaqPage.php"><i class='bx bx-sm bx-info-circle mr-2' ></i>FAQ</a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="adminHelpPage.php"><i class='bx bx-sm bx-help-circle mr-2' ></i>Help</a>
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
                    <h1 id="greeting">Welcome back to the administrator's portal, <?php echo $_SESSION['name'] ?>.</h1>
                    <div class="row mt-4">
                        <div class="col-xl-4 col-sm-6 col-12 mb-3">
                            <div class="card shadow" style="border-radius: 10px; border-color: white;">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 id="amountOfImages" class="text-primary"></h3>
                                                <span>Images Available</span>
                                            </div>
                                            <div class="align-self-center">
                                                <i class='bx bx-md bx-image text-primary'></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12 mb-3">
                            <div class="card shadow" style="border-radius: 10px; border-color: white;">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 id="lessonsCompleted" style="color: #00D207"></h3>
                                                <span>Lessons Created</span>
                                            </div>
                                            <div class="align-self-center">
                                                <i class='bx bx-md bx-book-open' style="color: #00D207"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12 mb-3">
                            <div class="card shadow" style="border-radius: 10px; border-color: white;">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 id="quizzesCompleted" style="color: #FF5662"></h3>
                                                <span>Quizzes Created</span>
                                            </div>
                                            <div class="align-self-center">
                                                <i class='bx bx-md bxs-edit'  style="color: #FF5662"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-xl-6 col-sm-12 col-12 mb-3">
                            <div class="card shadow" style="border-radius: 10px; border-color: white;">
                                <div class="row p-2">
                                    <div class="col-sm-9 d-flex flex-column justify-content-center">
                                        <h3 class="card-title">Manage Images</h3>
                                        <p>Insert, remove and update Histologie's images.</p>
                                        <a href="#" class="stretched-link"></a>
                                    </div>
                                    <div class="col-sm-3 d-flex align-items-center justify-content-center">
                                        <i class='bx bx-image text-primary' style="font-size: 88px;"></i>
                                    </div>                                  
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-12 col-12 mb-3">
                            <div class="card shadow" style="border-radius: 10px; border-color: white;">
                                <div class="row p-2">
                                    <div class="col-sm-9 d-flex flex-column justify-content-center">
                                        <h3 class="card-title">Manage Lessons</h3>
                                        <p>Add, edit or delete Histologie's lessons.</p>
                                        <a href="#" class="stretched-link"></a>
                                    </div>
                                    <div class="col-sm-3 d-flex align-items-center justify-content-center">
                                        <i class='bx bx-book-open' style="font-size: 88px; color: #00D207"></i>
                                    </div>                                  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-sm-12 col-12 mb-3">
                            <div class="card shadow" style="border-radius: 10px; border-color: white;">
                                <div class="row p-2">
                                    <div class="col-sm-9 d-flex flex-column justify-content-center">
                                        <h3 class="card-title">Manage Quizzes</h3>
                                        <p>Create, edit and remove Histologie's quizzes.</p>
                                        <a href="manageQuizzes.php" class="stretched-link"></a>
                                    </div>
                                    <div class="col-sm-3 d-flex align-items-center justify-content-center">
                                        <i class='bx bxs-edit' style="font-size: 88px; color: #FF5662"></i>
                                    </div>                                  
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-12 col-12 mb-3">
                            <div class="card shadow" style="border-radius: 10px; border-color: white;">
                                <div class="row p-2">
                                    <div class="col-sm-9 d-flex flex-column justify-content-center">
                                        <h3 class="card-title">Manage Students</h3>
                                        <p>Add, edit or delete students on Histologie.</p>
                                        <a href="manageStudents.php" class="stretched-link"></a>
                                    </div>
                                    <div class="col-sm-3 d-flex align-items-center justify-content-center">
                                        <i class='bx bx-user text-warning' style="font-size: 88px;"></i>
                                    </div>                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
