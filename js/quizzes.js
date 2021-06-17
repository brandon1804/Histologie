$(document).ready(function () {
    reload_quizzes();
    updateQuizzes();
    updateQuizHistoryTable();
}); //end of document ready


function updateQuizzes() {
    $.ajax({
        type: "GET",
        url: "http://localhost/Histologie/QuizPHPFiles/getQuizzes.php",
        cache: false,
        dataType: "JSON",
        success: function (response) {
            var message = "";
            for (i = 0; i < response.length; i++) {
                message += "<div class='col-sm-12 col-md-6 col-lg-6 col-xl-4'>"
                        + "<div class='card shadow' style='width: 20rem;' id=" + response[i].quiz_id + ">"
                        + "<img class='card-img-top' src='css/img/quizImg/" + response[i].name + "' alt='quizImage'>"
                        + "<div class='card-body'>"
                        + "<h5 class='card-title'>" + response[i].title + "</h5>"
                        + "<h6 class='card-subtitle mb-2 text-muted'>" + response[i].summary + "<br>" + response[i].questions + " Questions  " + response[i].score + " Marks</h6>"
                        + "<a href='quizPage.php?id=" + response[i].quiz_id + "' class='btn btn-primary stretched-link'>Take Quiz</a>"
                        + "</div></div></div>";
            }
            $("#quizzesRow").html(message);
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}//end of updateQuizzes

function updateQuizHistoryTable() {
    $.ajax({
        type: "GET",
        url: "http://localhost/Histologie/QuizPHPFiles/getQuizHistory.php",
        cache: false,
        dataType: "JSON",
        success: function (response) {
            var message = "";
            for (i = 0; i < response.length; i++) {
                message += "<tr>"
                        + "<td>" + response[i].quiz_taken_date + "</td>"
                        + "<td>" + response[i].title + "</td>"
                        + "<td>" + response[i].user_score + " / " + response[i].score + "</td>"
                        + "</tr>";
            }
            $("#quizHistoryTable tbody").html(message);
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}//end of updateQuizHistoryTable



function reload_quizzes() {
    $("#idQuizCategoryChooser").change(function () {
        var categoryID = $("#idQuizCategoryChooser").val();

        if (categoryID == 0) {
            updateQuizzes();
        } else {
            $.ajax({
                type: "GET",
                url: "http://localhost/Histologie/QuizPHPFiles/getQuizByCategory.php",
                data: "id=" + categoryID,
                cache: false,
                dataType: "JSON",
                success: function (response) {
                    var message = "";
                    for (i = 0; i < response.length; i++) {
                        message += "<div class='col-sm-6 col-lg-4'>"
                                + "<div class='card shadow' style='width: 20rem;' id=" + response[i].quiz_id + ">"
                                + "<img class='card-img-top' src='css/img/quizImg/" + response[i].name + "' alt='quizImage'>"
                                + "<div class='card-body'>"
                                + "<h5 class='card-title'>" + response[i].title + "</h5>"
                                + "<h6 class='card-subtitle mb-2 text-muted'>" + response[i].summary + "<br>" + response[i].questions + " Questions  " + response[i].score + " Marks</h6>"
                                + "<a href='quizPage.php?id=" + response[i].quiz_id + "' class='btn btn-primary stretched-link'>Take Quiz</a>"
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
}//end of reload_table()