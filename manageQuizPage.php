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

include("AdministratorPHPFiles\getNumOfQuizQuestions.php");
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Manage Quiz</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="icon.png">
        <link rel="stylesheet" href="css/all.css">
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/manageQuizPage.css">
        <link rel="stylesheet" href="css/progresscircle.css">
        <link rel="stylesheet" href="css/mfb.css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="https://use.typekit.net/dte4shr.css">
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="js/additional-methods.min.js" type="text/javascript"></script>
        <script src="js/progresscircle.js"></script>
        <script src="js/manageQuizPage.js" type="text/javascript"></script>
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
                    <h1 id="quizNumOfQuestions" hidden><?php echo $quizNumOfQuestions; ?></h1>
                    <div class="row justify-content-between mb-3"> 
                        <div class="col-6">
                            <h1 id="quizTitle"></h1>
                        </div>
                        <div class="col-6 d-flex justify-content-end align-items-center">
                            <a class="btn btn-primary d-flex align-items-center" href="quizPage.php?id=<?php echo $id ?>" role="button"><i class='bx bx-sm bx-play'></i>Preview Quiz</a>
                        </div>
                    </div>
                    <div class="card shadow" style="border-color: #fff;">
                        <div class="table-responsive">
                            <table id="questionsTable" class="table table-borderless" cellspacing="0" width="100%">
                                <thead style="background-color: #fafafa;">
                                    <tr>
                                        <th>Question</th>
                                        <th>Type</th>
                                        <th>Score</th> 
                                        <th>Answer</th> 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="modal fade" id="delete_question_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Question?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p style="color: black">This action is irreversible.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger btnDeleteQuestion">Delete Question</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="delete_quiz_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Quiz?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p style="color: black">This action is irreversible.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger modalBtnDeleteQuiz">Delete Quiz</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" id="quiz_deleted_modal">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Quiz Deleted</h5>
                                </div>
                                <div class="modal-body text-center"> 
                                    <div class="modal-body text-center">
                                        <div class="spinner-border" style="width: 3rem; height: 3rem;  color: #E11A7A;" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div><br><br>
                                        <p style="color: black">Quiz has been deleted successfully, you will be redirected to the manage quizzes page shortly.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="question_validation_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-danger">Action Restricted</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p style="color: black">A quiz should have at least one question at any point of time.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul id="menu" class="mfb-component--br mfb-slidein" data-mfb-toggle="click" data-mfb-state="closed">
                        <li class="mfb-component__wrap">
                            <a class="mfb-component__button--main" style="color: white; background-color: #0d6efd">
                                <i class="mfb-component__main-icon--resting ion-android-more-vertical" style="font-size: 22px"></i>
                                <i class="mfb-component__main-icon--active ion-close-round"></i>
                            </a>
                            <ul class="mfb-component__list">
                                <li>
                                    <a data-mfb-label="Add Question" class="mfb-component__button--child addQuestionBtn" style="padding-left: 0px !important; color: white; background-color: #00D207">
                                        <i class="mfb-component__child-icon ion-plus-round" style="font-size: 22px"></i>
                                    </a>
                                </li>
                                <li>
                                    <a data-mfb-label="Edit Quiz Details" class="mfb-component__button--child editQuizBtn" style="padding-left: 0px !important; color: white; background-color: #ffbb33">
                                        <i class="mfb-component__child-icon ion-edit" style="font-size: 22px"></i>
                                    </a>
                                </li>
                                <li>
                                    <a data-mfb-label="Delete Quiz" class="mfb-component__button--child deleteQuizBtn" style="padding-left: 0px !important; color: white; background-color: #dc3545">
                                        <i class="mfb-component__child-icon ion-trash-b" style="font-size: 22px"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <script src="js/mfb.js"></script>
                </div>
            </div>
        </div>
    </body>
</html>
