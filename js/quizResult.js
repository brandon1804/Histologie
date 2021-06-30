$(document).ready(function () {


    updateQuizResultPage();
    showQuizzes();

}); //end of document ready


function updateQuizResultPage() {
    var url = window.location.href;
    var stuff = url.split('=');
    var quiz_id = stuff[stuff.length - 1];

    $.ajax({
        type: "GET",
        url: "http://localhost/Histologie/QuizPHPFiles/getQuizResult.php",
        data: "quiz_id=" + quiz_id,
        cache: false,
        dataType: "JSON",
        success: function (response) {
            var userScore = response['user_score'];
            var quizScore = response['score'];
            var percentage = (userScore / quizScore) * 100;

            $("#quizTitle").text(response['title'] + " Quiz Results");
            $("#score").html(userScore + "/" + quizScore);


            if (percentage >= 80) {
                $(".circlechart").text("Well done!");
            } 
            else if (percentage < 80) {
                $(".circlechart").text("Good try!");
            } 



            $(".circlechart").attr("data-percentage", Math.round(percentage));


            $('.circlechart').circlechart();


        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}//end of updateQuizLandingPage

function showQuizzes() {
    $.ajax({
        type: "GET",
        url: "http://localhost/Histologie/QuizPHPFiles/getQuizzes.php",
        cache: false,
        dataType: "JSON",
        success: function (response) {
            var message = "";
            for (i = 0; i < response.length; i++) {
                message += "<div class='col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-5'>"
                        + "<div class='card shadow' style='width: 20rem;' id=" + response[i].quiz_id + ">"
                        + "<img class='card-img-top' src='css/img/quizImg/" + response[i].filename + "' alt='quizImage'>"
                        + "<div class='card-body'>"
                        + "<h5 class='card-title'>" + response[i].title + "</h5>"
                        + "<h6 class='card-subtitle mb-2 text-muted'>" + response[i].summary + "<br>" + response[i].questions + " Questions  | " + response[i].score + " Marks</h6>"
                        + "<a href='quizPage.php?id=" + response[i].quiz_id + "' class='btn btn-primary stretched-link'>Take Quiz</a>"
                        + "</div></div></div>";
            }
            $("#quizzesRow").html(message);
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}//end of showQuizzes


