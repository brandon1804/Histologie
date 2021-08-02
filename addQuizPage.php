<?php
session_start();
include("dbFunctions.php");
if (!isset($_SESSION['user_id'])) {
    header("Location: signinpage.php");
    exit();
}//end of session validation

if (isset($_SESSION['user_id']) && isset($_SESSION['account_type'])) {
    $accountType = $_SESSION['account_type'];
    if ($accountType !== "staff") {
        header("Location: accessDeniedPage.php");
        exit();
    } else {
        $quizCategories = array();
        $query = "SELECT * FROM quiz_category";
        $result = mysqli_query($link, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $quizCategories[] = $row;
        }
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
        <title>Add Quiz</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="icon.png">
        <link rel="stylesheet" href="css/all.css">
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/addQuizPage.css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://use.typekit.net/dte4shr.css">
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/piexif.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/sortable.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/fileinput.min.js"></script>
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="js/additional-methods.min.js" type="text/javascript"></script>
        <script src="js/addQuizPage.js" type="text/javascript"></script>
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
                    <h1 id="headerTitle"></h1>
                    <div id="addQuizContent" class="mt-4 mb-4">
                        <div class="col-12">
                            <div class="card shadow" style="border-color: #fff; border-radius: 10px;">
                                <div class="card-body">
                                    <h1 class="card-title mb-4">Add Quiz</h1>
                                    <form id="addQuizForm" enctype="multipart/form-data"> 
                                        <input id='quizImageUpload' name="quizImage" type="file" data-show-upload="false" accept="image/*" data-browse-on-zone-click="true" data-msg-placeholder="Select image for upload">
                                        <div class="form-group mt-3">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" name="title" placeholder="Enter the quiz title">
                                        </div>
                                        <div class="form-group">
                                            <label for="summary">Summary</label>
                                            <input type="text" class="form-control" name="summary" placeholder="A short summary of the quiz">
                                        </div>
                                        <div class="form-group">
                                            <label>Use Existing Category</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="categoryYN" id="categoryY" value="Yes">
                                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="categoryYN" id="categoryN" value="No">
                                                <label class="form-check-label" for="inlineRadio2">No</label>
                                            </div>
                                            <br><label for="categoryYN" class="error" style="display:none;">Please specify whether you are using an existing category</label>
                                        </div>
                                        <div class="form-group" id ="quizCategorySelectContent">
                                            <label for="quizCategoryChooser">Select Quiz Category</label>
                                            <select class="form-control" id="quizCategoryChooser" required>
                                                <option value="">Select Quiz Category</option>
                                                <?php
                                                for ($i = 0; $i < count($quizCategories); $i++) {
                                                    ?>
                                                    <option value="<?php echo $quizCategories[$i]['quizcategory_id']; ?>"><?php echo $quizCategories[$i]['category_name']; ?></option>                 
                                                <?php } ?>        
                                            </select>
                                        </div>
                                        <div class="form-group" id ="quizCategoryInputContent">
                                            <label for="quizCategoryInput">Quiz Category</label>
                                            <input type="text" class="form-control" name="quizCategoryInput" placeholder="Enter the quiz's category" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Time Limit</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="timeLimitYN" id="timeLimitY" value="Yes">
                                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="timeLimitYN" id="timeLimitN" value="No">
                                                <label class="form-check-label" for="inlineRadio2">No</label>
                                            </div>
                                            <br><label for="timeLimitYN" class="error" style="display:none;">Please specify whether there is a time limit</label>
                                        </div>
                                        <div id="timeLimit">
                                            <label>Set Time Limit</label>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group" id="minutesSelect">

                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group" id="secondsSelect">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row-reverse">
                                            <button type="submit" id = "submitAddQuizBtn" class="btn btn-primary d-flex align-items-center">Next<i class='bx bx-sm bx-right-arrow-alt'></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="addQuestionContent" class="mt-4 mb-4">
                        <div class="col-12">
                            <div class="card shadow" style="border-color: #fff; border-radius: 10px;">
                                <div class="card-body">
                                    <h1 class="card-title mb-4">Add Question</h1>
                                    <form id="addQuestionForm" enctype="multipart/form-data">
                                        <input id='files' name="files[]" multiple type="file" data-show-upload="false" accept="image/*" data-browse-on-zone-click="true" data-msg-placeholder="Select images for upload (Optional)">
                                        <small class="form-text text-primary">Click on the dropzone or browse button to add new images and select the images in the order you want them to display if you have multiple images.</small>
                                        <div class="form-group mt-3">
                                            <label for="question">Question</label>
                                            <textarea class="form-control" name="question" rows="3" placeholder="Enter the question"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="questionType">Question Type</label>
                                            <select class="form-control" name="questionTypeSelect" id="questionType" required>
                                                <option value="">Select Question Type</option>
                                                <option value="0">Multiple Choice Question</option>
                                                <option value="1">Fill in the blanks</option>
                                                <option value="2">Drop-down</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="questionScore">Question Score</label>
                                            <input type="text" class="form-control" name="questionScore" placeholder="Enter the question score">
                                        </div>
                                        <div class="form-group">
                                            <label for="questionAnswer">Question Answer</label>
                                            <input type="text" class="form-control" name="questionAnswer" placeholder="Enter the question's answer(s)">
                                            <small class="form-text text-primary" id="answersInfo">Please separate the answers with a comma. Eg. Answer A, Answer B</small>
                                        </div>
                                        <div class="form-group" id='optionsCountDiv'>
                                            <hr/>
                                            <label for="optionsCount">Number of options</label>
                                            <select class="form-control" name="optionsCountSelect" id="optionsCount" required>
                                                <option value="">Select number of options</option>
                                                <option value=2 selected>2</option>
                                                <option value=3>3</option>
                                                <option value=4>4</option>
                                            </select>
                                        </div>
                                        <div id='questionOptionsTextFields'>
                                        </div>
                                        <div class="form-group" id='inputsCountDiv'>
                                            <hr/>
                                            <label for="inputsCount">Number of inputs</label>
                                            <select class="form-control" id="inputsCount" required>
                                                <option value=1 selected>1</option>
                                                <option value=2>2</option>
                                                <option value=3>3</option>
                                                <option value=4>4</option>
                                            </select>
                                        </div>
                                        <div class="d-flex flex-row-reverse mt-4">
                                            <button type="submit" id = "saveBtn" class="btn btn-primary d-flex align-items-center"><i class='bx bx-sm bx-save'></i>Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="category_exists_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-danger">Category Already Exists!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p style="color: black">Please change your category.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" id="publish_quiz_modal">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Quiz Published!</h5>
                                </div>
                                <div class="modal-body text-center"> 
                                    <div class="modal-body text-center">
                                        <p style="color: black">The quiz has been published, would you like to ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a class="btn btn-primary d-flex align-items-center" href="manageQuizzes.php" role="button"><i class='bx bx-sm bx-edit-alt'></i>Manage Quizzes</a>
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
