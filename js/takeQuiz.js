$(document).ready(function () {

    updateQuizPage();
    updateQuizQuestion();
    var currValue = 1;
    updateProgress(currValue);

    $("#nextBtn").click(function () {
        currValue += 1;
        updateProgress(currValue);
    });


}); //end of document ready


function updateQuizQuestion() {
    var url = window.location.href;
    var stuff = url.split('=');
    var quiz_id = stuff[stuff.length - 1];




    $.ajax({
        type: "GET",
        url: "http://localhost/Histologie/QuizPHPFiles/getQuizQuestions.php",
        data: "quiz_id=" + quiz_id,
        cache: false,
        dataType: "JSON",
        success: function (response) {

            console.log(shuffleQuestions(response));
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });



    $.ajax({
        type: "GET",
        url: "http://localhost/Histologie/QuizPHPFiles/getQuizQuestionById.php",
        data: "quiz_id=" + quiz_id + "&question_id=" + 1,
        cache: false,
        dataType: "JSON",
        success: function (response) {

            console.log(response);
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}//end of updateQuizQuestion


function updateQuizPage() {

    var url = window.location.href;
    var stuff = url.split('=');
    var quiz_id = stuff[stuff.length - 1];

    $.ajax({
        type: "GET",
        url: "http://localhost/Histologie/QuizPHPFiles/getQuizDetails.php",
        data: "id=" + quiz_id,
        cache: false,
        dataType: "JSON",
        success: function (response) {

            $('#quizTitle').html(response["title"]);
            var quizTime = response["duration"];
            var interval = setInterval(function () {

                var quizTimer = quizTime.split(':');

                var minutes = parseInt(quizTimer[0], 10);
                var seconds = parseInt(quizTimer[1], 10);
                --seconds;
                minutes = (seconds < 0) ? --minutes : minutes;
                seconds = (seconds < 0) ? 59 : seconds;
                seconds = (seconds < 10) ? '0' + seconds : seconds;

                $('#quizTimer').html(minutes + ':' + seconds);
                if (minutes < 0)
                    clearInterval(interval);

                if ((seconds <= 0) && (minutes <= 0)) {
                    clearInterval(interval);
                    $('#quiz_end_modal').modal('show');
                    setTimeout(function () {
                        window.location.replace("http://localhost/Histologie/quizzesPage.php");
                    }, 3000)
                }

                quizTime = minutes + ':' + seconds;
            }, 1000);
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });



}//end of updateQuizPage

function updateProgress(currValue) {
    var url = window.location.href;
    var stuff = url.split('=');
    var quiz_id = stuff[stuff.length - 1];

    $.ajax({
        type: "GET",
        url: "http://localhost/Histologie/QuizPHPFiles/getQuizDetails.php",
        data: "id=" + quiz_id,
        cache: false,
        dataType: "JSON",
        success: function (response) {

            var questions = response["questions"];
            var percentage = currValue / questions * 100;
            $(".progress-bar").css("width", percentage + "%");
            $(".progress-bar").attr("aria-valuenow", percentage);

            if (percentage === 100) {
                $("#nextBtn").text("End Quiz");
            }

        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });

}//end of updateProgress

function shuffleQuestions(array) {
    for (var i = array.length - 1; i > 0; i--) {


        var j = Math.floor(Math.random() * (i + 1));

        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }

    return array;
}//end of shuffleQuestions