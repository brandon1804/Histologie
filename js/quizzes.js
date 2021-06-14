$(document).ready(function () {

    updateQuizzes();
    updateQuizHistoryTable();
}); //end of document ready

                
function updateQuizzes() {
    $.ajax({
        type: "GET",
        url: "getQuizzes.php",
        cache: false,
        dataType: "JSON",
        success: function (response) {
            var message = "";
            for (i = 0; i < response.length; i++) {
                message += "<div class='col-sm-6 col-lg-4'>"
                        + "<div class='card shadow' style='width: 20rem;' id=" + response[i].quiz_id + ">"
                        + "<img class='card-img-top' src='css/img/" + response[i].name + "' alt='quizImage'>"
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
        url: "getQuizHistory.php",
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

