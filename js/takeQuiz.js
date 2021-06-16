$(document).ready(function () {

    var timesUp = false;
    updateTakeQuizPage();
    setQuizTimer();



}); //end of document ready


function updateTakeQuizPage() {
    var url = window.location.href;
    var stuff = url.split('=');
    var quiz_id = stuff[stuff.length - 1];

    $.ajax({
        type: "GET",
        url: "http://localhost/Histologie/QuizPHPFiles/getQuizQuestionById.php",
        data: "quiz_id=" + quiz_id + "&question_id=" + quiz_id,
        cache: false,
        dataType: "JSON",
        success: function (response) {
            var message = "";

            console.log(response);
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}//end of updateTakeQuizPage


function setQuizTimer() {

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



}//end of setQuizTimer


