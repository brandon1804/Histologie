$(document).ready(function () {

    updateQuizLandingPage();


}); //end of document ready


function updateQuizLandingPage() {
    var url = window.location.href;
    var stuff = url.split('=');
    var id = stuff[stuff.length - 1];

    $.ajax({
        type: "GET",
        url: "QuizPHPFiles/getQuizDetails.php",
        data: "id=" + id,
        cache: false,
        dataType: "JSON",
        success: function (response) {
            var message = "";

            
            if (response.attempts !== 0 && response.topScore !== null) {
                message += "<div class='card shadow' style='width: 50rem;' id=" + response.quiz_id + ">"
                        + "<img class='card-img-top' src='css/img/quizImg/" + response.filename + "' alt='quizImage'>"
                        + "<div class='card-body'>"
                        + "<h2 class='card-title'>" + response.title + "</h5>"
                        + "<h6 class='card-subtitle mb-2 text-muted'>" + response.summary + "<br>" + response.questions + " Questions  | " + response.score + " Marks</h6>"
                        + "<br><h6 class='card-subtitle mb-2 text-muted'>" + response.attempts + " attempt(s) thus far</h6>"
                        + "<div class='row justify-content-between'><div class='col-sm-8 col-xl-6'><h6 class='card-subtitle mb-2 text-muted'>Highest Score: " + response.topScore + "<br>Lowest Score: " + response.minScore + "</h6></div>"
                        + "<div class='col-sm-4 col-xl-6 d-flex justify-content-end align-items-center'><a href='takeQuizPage.php?id=" + response.quiz_id + "' class='stretched-link'><i class='bx bx-right-arrow-alt bx-md'></i></a>"
                        + "</div></div></div></div>";
            }//end of if

            else {
                message += "<div class='card shadow' style='width: 50rem;' id=" + response.quiz_id + ">"
                        + "<img class='card-img-top' src='css/img/quizImg/" + response.filename + "' alt='quizImage'>"
                        + "<div class='card-body'>"
                        + "<h2 class='card-title'>" + response.title + "</h5>"
                        + "<div class='row justify-content-between'><div class='col-sm-8 col-xl-6'><h6 class='card-subtitle mb-2 text-muted'>" + response.summary + "<br>" + response.questions + " Questions  | " + response.score + " Marks</h6></div>"
                        + "<div class='col-sm-4 col-xl-6 d-flex justify-content-end align-items-center'><a href='takeQuizPage.php?id=" + response.quiz_id + "' class='stretched-link'><i class='bx bx-right-arrow-alt bx-md'></i></a>"
                        + "</div></div></div></div>";
            }//end of attempts validation


            $("#quizDetails").html(message);
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}//end of updateQuizLandingPage


