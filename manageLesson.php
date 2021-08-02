<?php
session_start();
include("dbFunctions.php");
//if (!isset($_SESSION['user_id'])) {
//    header("Location: signinpage.php");
//    exit();
//}//end of session validation

//if (isset($_SESSION['user_id']) && isset($_SESSION['account_type'])) {
//    $accountType = $_SESSION['account_type'];
//    if ($accountType !== "staff") {
//        header("Location: accessDeniedPage.php");
//        exit();
//    } else {
        $lessonCategory = array();
        $query = "SELECT * FROM lesson_category";
        $result = mysqli_query($link, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $lessonCategory[] = $row;
        }
//    }
//}//end of account type validation
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Lessons</title>
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

        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        
        <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

        <link rel="stylesheet" href="./css/manageLessonPage.css">
        <script src="./js/manageLesson.js"></script>
        <script>
            var category = <?php echo json_encode($lessonCategory)?>;
        </script>
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
                    <li class="active">
                        <a class="d-flex align-items-center" href="manageLesson.php"><i class='bx bx-sm bx-book-open mr-2'></i>Lessons</a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="manageQuizzes.php"><i class='bx bx-sm bxs-edit mr-2' ></i>Quizzes</a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="manageFaqPage.php"><i class='bx bx-sm bx-info-circle mr-2' ></i>FAQ</a>
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
                            <h1>Lessons</h1>
                        </div>
                        <div class="col-6 d-flex justify-content-end align-items-center">
                            <a class="btn d-flex align-items-center" href="addLessonPage.php" role="button" style="background-color: #00D207; color:#fff"><i class='bx bx-sm bx-plus'></i>Add Lesson</a>
                        </div>
                    </div>
                    <div class="row mt-4 mb-5">
                        <div class="col-xl-4 col-sm-6 col-12 mb-3">
                            <div class="card shadow" style="border-radius: 10px; border-color: white;">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 id="lessonAvailable" style="color: #FF5662"></h3>
                                                <span>Lessons Available</span>
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
                    <div class="row justify-content-between"> 
                        <div class="col-6">
                            <h1>Manage Lessons</h1>
                        </div>
                        <div class="col-6 d-flex justify-content-end align-items-center">
                            <select class="form-control" id="lessonCategoryChooser">
                                <option value="0">Select Lesson Category</option>
                                <?php
                                for ($i = 0; $i < count($lessonCategory); $i++) {
                                    ?>
                                    <option value="<?php echo $lessonCategory[$i]['lesson_category_id']; ?>"><?php echo $lessonCategory[$i]['name']; ?></option>                 
                                <?php } ?>        
                            </select>
                        </div>
                    </div>
                    <div id="lessonrow" class="row d-flex flex-column flex-nowrap overflow-y-auto accordion">
                        
                    </div><br><br>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editLessonModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLessonModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLessonModalLabel">Edit Lesson Details</h5>
                    <button type="button" class="btn modal-close"><i class='bx bx-x'></i></button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger modal-close" >Close</button>
                    <button type="button" class="btn btn-success modal-submit">Save changes</button>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>
