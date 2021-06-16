$(document).ready(function () {

    updateQuizLandingPage();


}); //end of document ready


function updateQuizLandingPage() {
    var url = window.location.href;
    var stuff = url.split('=');
    var id = stuff[stuff.length - 1];

    $.ajax({
        type: "GET",
        url: "http://localhost/Histologie/QuizPHPFiles/getQuizDetails.php",
        data: "id=" + id,
        cache: false,
        dataType: "JSON",
        success: function (response) {
            var message = "";
            message += "<div class='card shadow' style='width: 50rem;' id=" + response.quiz_id + ">"
                    + "<img class='card-img-top' src='css/img/quizImg/" + response.name + "' alt='quizImage'>"
                    + "<div class='card-body'>"
                    + "<h5 class='card-title'>" + response.title + "</h5>"
                    + "<h6 class='card-subtitle mb-2 text-muted'>" + response.summary + "<br>" + response.questions + " Questions  | " + response.score + " Marks</h6>"
                    + "<a href='takeQuizPage.php?id=" + response.quiz_id + "' class='btn btn-success'>Begin Quiz</a>"
                    + "</div></div>";

            $("#quizDetails").html(message);
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}//end of updateQuizLandingPage

