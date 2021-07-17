$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    reload_quizzes();
    updateQuizzes();
    updateCards();

}); //end of document ready

function updateQuizzes() {
    $.ajax({
        type: "GET",
        url: "QuizPHPFiles/getQuizzes.php",
        cache: false,
        dataType: "JSON",
        success: function (response) {
            var message = "";
            for (i = 0; i < response.length; i++) {
                message += "<div class='col-sm-12 col-md-6 col-lg-4 col-xl-4'>"
                        + "<div class='card shadow' style='width: 20rem' id=" + response[i].quiz_id + ">"
                        + "<img class='card-img-top' src='css/img/quizImg/" + response[i].filename + "' alt='quizImage'>"
                        + "<div class='card-body'>"
                        + "<h5 class='card-title'>" + response[i].title + "</h5>"
                        + "<h6 class='card-subtitle mb-2 text-muted'>" + response[i].summary + "<br>" + response[i].questions + " Questions  " + response[i].score + " Marks</h6>"
                        + "<a href='manageQuizPage.php?quiz_id=" + response[i].quiz_id + "' class='btn btn-primary mr-2'>Manage Quiz</a>"
                        + "<a href='quizStatisticsPage.php?id=" + response[i].quiz_id + "' class='btn btn-success mr-2'>Quiz Statistics</a>"
                        + "</div></div></div>";
            }
            $("#quizzesRow").html(message);
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}//end of updateQuizzes

function reload_quizzes() {
    $("#idQuizCategoryChooser").change(function () {
        var categoryID = $("#idQuizCategoryChooser").val();

        if (categoryID == 0) {
            updateQuizzes();
        } else {
            $.ajax({
                type: "GET",
                url: "QuizPHPFiles/getQuizByCategory.php",
                data: "id=" + categoryID,
                cache: false,
                dataType: "JSON",
                success: function (response) {
                    var message = "";
                    for (i = 0; i < response.length; i++) {
                        message += "<div class='col-sm-6 col-lg-4'>"
                                + "<div class='card shadow' style='width: 20rem' id=" + response[i].quiz_id + ">"
                                + "<img class='card-img-top' src='css/img/quizImg/" + response[i].filename + "' alt='quizImage'>"
                                + "<div class='card-body'>"
                                + "<h5 class='card-title'>" + response[i].title + "</h5>"
                                + "<h6 class='card-subtitle mb-2 text-muted'>" + response[i].summary + "<br>" + response[i].questions + " Questions  " + response[i].score + " Marks</h6>"
                                + "<a href='manageQuizPage.php?quiz_id=" + response[i].quiz_id + "' class='btn btn-primary mr-2'>Manage Quiz</a>"
                                + "<a href='quizStatisticsPage.php?id=" + response[i].quiz_id + "' class='btn btn-success mr-2'>Quiz Statistics</a>"
                                + "</div></div></div>";
                    }
                    $("#quizzesRow").html(message);
                },
                error: function (obj, textStatus, errorThrown) {
                    console.log("Error " + textStatus + ": " + errorThrown);
                    $("#quizzesRow").html("");
                }
            });
        }//end of else 

    });
}//end of reload_quizzes()

function updateCards() {
    $.ajax({
        type: "GET",
        url: "AdministratorPHPFiles/getManageQuizzesContent.php",
        cache: false,
        dataType: "JSON",
        success: function (response) {
            $("#quizzesAvailable").text(response['quizzesA']);
            $("#quizzesCompleted").text(response['quizzesC']);
            $("#passPercentage").text(response['passPercentage'] + "%");
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}//end of updateCards