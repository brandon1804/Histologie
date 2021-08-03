<?php
session_start();
include("dbFunctions.php");
//if (!isset($_SESSION['user_id'])) {
//    header("Location: signinpage.php");
//    exit();
//}//end of session validation
//
//if (isset($_SESSION['user_id']) && isset($_SESSION['account_type'])) {
//    $accountType = $_SESSION['account_type'];
//    if ($accountType !== "staff") {
//        header("Location: accessDeniedPage.php");
//        exit();
//    } else {
$faqs = array();
$query = "SELECT * FROM frequent_ask_questions";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $faqs[] = $row;
}
//    }
//}//end of account type validation
//
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://use.typekit.net/dte4shr.css">
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="js/additional-methods.min.js" type="text/javascript"></script>

        <link rel="stylesheet" href="./css/manageFaqPage.css">
        <script src="./js/manageFaqPage.js"></script>
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
                        <a class="d-flex align-items-center" href="manageLesson.php"><i class='bx bx-sm bx-book-open mr-2'></i>Lessons</a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="manageQuizzes.php"><i class='bx bx-sm bxs-edit mr-2' ></i>Quizzes</a>
                    </li>
                    <li class="active">
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
            </nav>

            <!-- Page Content  -->
            <div id="content">
                <i id="sidebarCollapse" class='bx bx-sm bx-menu' style="color:#E11A7A"></i>
                <div class="container">
                    <div class="row justify-content-between"> 
                        <div class="col-6">
                            <h1>FAQs</h1>
                        </div>
                        <div class="col-6 d-flex justify-content-end align-items-center">
                            <a class="btn d-flex align-items-center" href="addFaqPage.php" role="button" style="background-color: #00D207; color:#fff"><i class='bx bx-sm bx-plus'></i>Add FAQ</a>
                        </div>
                    </div><br><br>
                    <div id="faq" class="row d-flex flex-row flex-nowrap overflow-hidden">
                        <div class="card shadow" style="border-color: #fff; border-radius: 10px; width: 100%;">
                            <div class="table-responsive overflow-hidden">
                                <table id="defaultTable" class="table table-borderless" cellspacing="0" width="100%">
                                    <thead style="background-color: #fafafa;">
                                        <tr>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $msg = "";
                                        foreach ($faqs as $i) {
                                            $msg .= "<tr>";
                                            $msg .= "<td><p>" . $i["faq_title"] . "</p></td>";
                                            $msg .= "<td class='faq-answer'><p>" . $i["faq_answer"] . "</td>";
                                            $msg .= "<td class='d-flex justify-content-around'>";
                                            $msg .= "<a class='btn d-flex align-items-center' role='button' style='background-color: #ffc107; color:#fff' href='./editFAQPage.php?id=" . $i['faq_id'] . "'><i class='bx bx-sm bx-pencil'></i>Edit Question</a>";
                                            $msg .= "<button class='btn d-flex align-items-center' role='button' style='background-color: #FF5662; color:#fff' onclick='deleteQuestion(" . $i['faq_id'] . ")'><i class='bx bx-sm bx-trash'></i>Delete Question</button>";
                                            $msg .= "</td>";
                                            $msg .= "</tr>";
                                        }
                                        echo $msg;
                                        ?>
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                    </div><br><br>
                </div>
            </div>
        </div>
    </body>
</html>