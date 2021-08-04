<?php
session_start();

include("dbFunctions.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: signinpage.php");
    exit();
}//end of user validation
else {
    $quizCategories = array();
    $query = "SELECT * FROM quiz_category";
    $result = mysqli_query($link, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $quizCategories[] = $row;
    }
}//end of else 


mysqli_close($link);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Quizzes</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="icon.png">
        <link rel="stylesheet" href="css/all.css">
        <link rel ="stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.typekit.net/dte4shr.css">
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
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
                height: 10rem;
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;
            }
            #quizzesRow{
                padding-top: 10px;
                padding-bottom: 10px;
            }
            #errorMsg{
                color: #E11A7A;
            }
        </style>
    </head>
    <body>
        <?php
        include("navbar.php");
        ?>
        <div class="container">
            <div class="row justify-content-between"> 
                <div class="col-6">
                    <h1>Quizzes</h1>
                </div>
                <div class="col-6 d-flex justify-content-end align-items-center">
                    <select class="form-control" id="idQuizCategoryChooser">
                        <option value="">Select Quiz Category</option>
                        <?php
                        for ($i = 0; $i < count($quizCategories); $i++) {
                            ?>
                            <option value="<?php echo $quizCategories[$i]['quizcategory_id']; ?>"><?php echo $quizCategories[$i]['category_name']; ?></option>                 
                        <?php } ?>        
                    </select>
                </div>
            </div>
            <div id="quizzesRow" class="row d-flex flex-row flex-nowrap overflow-auto">

            </div>
            <h1 class="mt-5">Quiz Statistics</h1>
            <div class="row mb-4" id="cardsRow">
                <div class="col-xl-4 col-sm-6 col-12 mb-3">
                    <div class="card shadow" style="border-radius: 10px; border-color: white;">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 id="quizzesCompleted" style="color: #00D207"></h3>
                                        <span>Quiz Attempts</span>
                                    </div>
                                    <div class="align-self-center">
                                        <i class='bx bx-md bxs-check-circle' style="color: #00D207"></i>
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
                                        <h3 id="passPercentage" class="text-primary"></h3>
                                        <span>Passing Rate</span>
                                    </div>
                                    <div class="align-self-center">
                                        <i class='bx bx-md bx-book-open text-primary'></i>
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
                                        <h3 id="asPercentage"  style="color: #9342f5"></h3>
                                        <span>Average Score</span>
                                    </div>
                                    <div class="align-self-center">
                                        <i class='bx bx-md bxs-edit-alt' style="color: #9342f5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow" id="historyCard" style="border-color: #fff; border-radius: 20px;">
                <div class="table-responsive">
                    <table id="quizHistoryTable" class="table table-borderless" cellspacing="0" width="100%">
                        <thead style="background-color: #fafafa;">
                            <tr><th>Date</th>
                                <th>Quiz Title</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <h5 id="errorMsg"></h5>
        </div>
    </body>
</html>

