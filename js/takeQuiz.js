$(document).ready(function () {

    updateQuizPage();
    var currValue = 1;
    var currQuestionIndex = 0;

    updateQuizQuestion(currQuestionIndex);
    updateProgress(currValue);

    $("#nextBtn").click(function () {
        currValue += 1;
        currQuestionIndex += 1;
        updateProgress(currValue);
        updateQuizQuestion(currQuestionIndex);
    });


}); //end of document ready


function updateQuizQuestion(currQuestionIndex) {
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

            var shuffledQuestionsArr = response;
            //var shuffledQuestionsArr = shuffleQuestions(response);
            //console.log(shuffledQuestionsArr);
            //console.log(shuffledQuestionsArr[currQuestionIndex]);

            if (currQuestionIndex < shuffledQuestionsArr.length) {
                $.ajax({
                    type: "GET",
                    url: "http://localhost/Histologie/QuizPHPFiles/getQuizQuestionById.php",
                    data: "quiz_id=" + quiz_id + "&question_id=" + shuffledQuestionsArr[currQuestionIndex],
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        var output = "";
                        $('#questionTitle').text(response["question"]);
                        if (response["images"].length !== 0) {
                            var imgArr = response["images"];
                            var optionsArr = response["question_options"];

                            if (imgArr.length === 1 && imgArr[0] !== "None") {
                                output += "<img class='img-fluid mb-3' src='css/img/quizImg/quiz" + quiz_id + "/" + imgArr[0] + "' alt='quizImage'>";
                            }//end of length 1

                            if (imgArr[0] === "None") {

                                for (var t = 0; t < optionsArr.length; t++) {

                                    var arr = optionsArr[t].split(",");
                                    output += "<div class='form-group'>"
                                           + "<label for='" + t + "'>Blank " + (t + 1) + "</label>"
                                           + "<select class='form-control w-25' id= '" + t + "'>"
                                           + "<option value=''>Select Answer</option>";

                                    for (var i = 0; i < arr.length; i++) {
                                        output += " <option value='" + arr[i] + "'>" + arr[i] + "</option>";
                                    }//end of dropdown for loop
                                    output += "</select></div>";

                                   

                                }//end of options for loop

                            }//end of length 1

                            else if (imgArr.length === 2) {
                                output += "<div class='row'>";
                                for (var i = 0; i < imgArr.length; i++) {
                                    output += "<div class='col-lg-6'>"
                                            + "<img class='img-fluid w-100 mb-3' src='css/img/quizImg/quiz" + quiz_id + "/" + imgArr[i] + "' alt='quizImage'>"
                                            + "<input type='text' class='form-control mb-3' id='" + optionsArr[i] + "'placeholder ='Fill in the blank'>"
                                            + "</div>";
                                }//end of images for loop

                                output += "</div>";
                            }//end of length 2
                            else if (imgArr.length > 2) {
                                output += "<div class='row'>";
                                for (var i = 0; i < 2; i++) {
                                    output += "<div class='col-lg-6'>"
                                            + "<img class='img-fluid w-100 mb-3' src='css/img/quizImg/quiz" + quiz_id + "/" + imgArr[i] + "' alt='quizImage'>"
                                            + "<input type='text' class='form-control mb-3' id='" + optionsArr[i] + "'placeholder ='Fill in the blank'>"
                                            + "</div>";
                                }//end of images for loop

                                output += "</div><div class='row'>";
                                for (var q = 2; q < 4; q++) {
                                    output += "<div class='col-lg-6'>"
                                            + "<img class='img-fluid w-100 mb-3' src='css/img/quizImg/quiz" + quiz_id + "/" + imgArr[q] + "' alt='quizImage'>"
                                            + "<input type='text' class='form-control mb-3' id='" + optionsArr[q] + "'placeholder ='Fill in the blank'>"
                                            + "</div>";
                                }//end of images for loop

                                output += "</div>";

                            }//end of length validation

                        }//end of image validation 

                        if (response["question_type"] === "MCQ") {
                            if (response["question_options"].length !== 0) {
                                var optionsArr = response["question_options"];
                                for (i = 0; i < optionsArr.length; i++) {

                                    output += "<div class='form-check'>"
                                            + "<input class='form-check-input' type='radio' name='questionOption' id='" + i + "'value= '" + optionsArr[i] + "'>"
                                            + "<label class='form-check-label' for=" + i + ">"
                                            + optionsArr[i]
                                            + "</label> </div>";
                                }//end of options for loop
                            }//end of options validation 

                        }//end of question type validation


                        $('#questionContent').html(output);
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });//end of getQuizQuestionById
            }//end of index validation
            else {
                $('#quiz_end_modal').modal('show');
                setTimeout(function () {
                    window.location.replace("http://localhost/Histologie/quizzesPage.php");
                }, 3000);
            }



        }, //end of getQuizQuestions
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
                    $('#times_up_modal').modal('show');
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