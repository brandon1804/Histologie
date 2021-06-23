<?php
session_start();

include("dbFunctions.php");

//if (!isset($_SESSION['user_id'])) {
//    header("Location: http://localhost/Histologie/signinpage.php");
//    exit();
//}//end of user validation
//else {
    $lessonCategories = array();
    $query = "SELECT * FROM lesson_category";
    $result = mysqli_query($link, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $lessonCategories[] = $row;
    }
//}//end of else 

mysqli_close($link);
?>
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
        <script src="js/learn.js" type="text/javascript"></script>
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
            .card img{
                width: 20rem;
                height: 10rem;
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;
            }
            .card{
                border-radius: 20px;
                width: 20rem;
                height: 22rem;
            }
            #lessonsRow{
                padding-top: 10px;
                padding-bottom: 10px;
            }
            h6{
                margin-right: 10px;
                margin-left: 10px;
                font-size: 16px;
            }
            h5{
                margin-left: 10px;
                margin-top: 5px;
            }
            btn{
                margin-top: 10px;
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
                    <h1>Learn</h1>
                </div>
                <div class="col-6 d-flex justify-content-end align-items-center">
                    <select class="form-control w-50" id="idLessonCategory">
                        <option value="">Select Lesson Category</option>
                        <?php
                        for ($i = 0; $i < count($lessonCategories); $i++) {
                            ?>
                            <option value="<?php echo $lessonCategories[$i]['lesson_category_id']; ?>"><?php echo $lessonCategories[$i]['name']; ?></option>                 
                        <?php } ?> 
                    </select>
                </div>
            </div>
            <h4>Lessons:</h4>
            <div id="lessonsRow" class="row d-flex flex-row flex-nowrap">

            </div><br><br>
 
        </div>
    </body>
</html>
