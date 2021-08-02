<?php
session_start();
include("dbFunctions.php");
//if (!isset($_SESSION['user_id'])) {
// header("Location: signinpage.php");
// exit();
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
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/learn.js" type="text/javascript"></script>
        <style type="text/css">
            body{
                font-family: europa,sans-serif;
                font-weight: 400;
                font-style: normal;
                padding-top: 70px;
                margin-top: 20px;
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
            card-body{
                margin-right: 10px;
                margin-left: 10px;
                font-size: 13px;
                margin-bottom: 10px;
            }
            card-subtitle{
                margin-right: 10px;
                margin-left: 10px;
                font-size: 13px;
                margin-bottom: 10px;
            }
            .card2{
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                border-radius: 20px;
                width: 69rem;
                height: 18rem;
                margin-right: 60px;
                margin-left: 10px;
            }
            .img-fluid{
                width: 25rem;
                height: 18rem;
                border-top-left-radius: 20px;
                border-bottom-left-radius: 20px;
            }
            .card-title2{
                margin-left: 10px;
                margin-top: 20px;
            }
            .card-subtitle2{
                margin-left: 10px;
            }
            .card-body2{
                align-content: center;
                justify-content: center;
            }
            .card3{
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                border-radius: 20px;
                margin-right: 60px;
                width: 20rem;
                height: 22rem;
            }
            .card-body3{
                margin-right: 10px;
                margin-left: 10px;
                font-size: 13px;
                margin-bottom: 10px;
            }
            .card-title3{
                margin-left: 10px;
                margin-top: 20px;
            }
            .card-subtitle3{
                margin-left: 10px;
            }
            .progress{
                margin-left: 10px;
            }
            .btn{
                margin-left: 5px;
            }
            .card-img-top{
                width: 20rem;
                height: 10rem;
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;
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
            </br>
            <h4>Recommended for you:</h4>
            <div id="lessons" class="row"></div>
            </br>
            <h4>Lessons:</h4>
            <div id="lessonsRow" class="row d-flex flex-row flex-nowrap overflow-auto">
            </div><br><br>
            <script src ="https://form.jotform.com/static/feedback2.js" type="text/javascript"></script><script type="text/javascript">
                var JFL_212135193912450 = new JotformFeedback({
                    formId: '212135193912450',
                    base: 'https://form.jotform.com/',
                    windowTitle: 'Feedback',
                    background: '#FFA500',
                    fontColor: '#FFFFFF',
                    type: 'false',
                    height: 500,
                    width: 700,
                    openOnLoad: false
                });
            </script>
            <a class="btn lightbox-212135193912450" style="margin-top: 16px">
                Feedback
            </a>
        </div>
    </body>
</html>
