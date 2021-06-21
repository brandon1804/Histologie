$(document).ready(function () {

    updateQuizPage();
    quizLogic();

}); //end of document ready



function quizLogic(callback) {
    var url = window.location.href;
    var stuff = url.split('=');
    var quiz_id = stuff[stuff.length - 1];

    $.ajax({
        url: "http://localhost/Histologie/QuizPHPFiles/getQuizQuestions.php",
        data: "quiz_id=" + quiz_id,
        type: 'GET',
        cache: false,
        dataType: "JSON",
        success: callback
    });
}

quizLogic(function (response) {
    var url = window.location.href;
    var stuff = url.split('=');
    var quiz_id = stuff[stuff.length - 1];
    var currValue = 1;
    var currQuestionIndex = 0;
    var savedAnswers = [];
    var marks = 0;

    let shuffledQuestionsArr = shuffleQuestions(response);
    console.log(shuffledQuestionsArr);
    updateQuizQuestion(currQuestionIndex, shuffledQuestionsArr);
    updateProgress(currValue);

    $("#nextBtn").click(function () {
        function validateAnswer(callback) {
            $.ajax({
                type: "GET",
                url: "http://localhost/Histologie/QuizPHPFiles/getQuizQuestionById.php",
                data: "quiz_id=" + quiz_id + "&question_id=" + shuffledQuestionsArr[currQuestionIndex],
                cache: false,
                dataType: "JSON",
                success: callback
            });
        }
        validateAnswer(function (response) {


            var isAnswered = false;
            if (response["images"].length !== 0) {
                var imgArr = response["images"];
                var optionsArr = response["question_options"];
                if (imgArr[0] === "None") {
                    var answersArr = [];
                    for (var i = 0; i < optionsArr.length; i++) {
                        answersArr.push($("#" + i + " option:selected").val());
                    }//end of options for loop

                    if (answersArr.length === optionsArr.length && !answersArr.includes("")) {
                        isAnswered = true;
                        var answerObj = {question_id: shuffledQuestionsArr[currQuestionIndex], user_answer: answersArr};
                        savedAnswers.push(answerObj);
                    }
                }//end of length 1

                else if (imgArr.length === 1 && optionsArr[0] === "0") {
                    var answer = ($("#" + i).val());
                    if (answer !== "") {
                        isAnswered = true;
                        var answerObj = {question_id: shuffledQuestionsArr[currQuestionIndex], user_answer: answer};
                        savedAnswers.push(answerObj);
                    }
                }//end of length 1 & 1 text field FIB


                else if (imgArr.length === 2 && optionsArr[0] === "0") {
                    var answersArr = [];
                    for (var i = 0; i < optionsArr.length; i++) {
                        answersArr.push($("#" + i).val());
                    }//end of options for loop

                    if (answersArr.length === optionsArr.length && !answersArr.includes("")) {
                        isAnswered = true;
                        var answerObj = {question_id: shuffledQuestionsArr[currQuestionIndex], user_answer: answersArr};
                        savedAnswers.push(answerObj);
                    }

                }//end of length 2

                else if (imgArr.length >= 2 && optionsArr[0] !== "0") {
                    var answersArr = [];
                    for (var i = 0; i < optionsArr.length; i++) {
                        answersArr.push($("#" + i + " option:selected").val());
                    }//end of options for loop

                    if (answersArr.length === optionsArr.length && !answersArr.includes("")) {
                        isAnswered = true;
                        var answerObj = {question_id: shuffledQuestionsArr[currQuestionIndex], user_answer: answersArr};
                        savedAnswers.push(answerObj);
                    }

                }//end of length 2 && FIB
            }//end of image validation 

            if (response["question_type"] === "MCQ") {

                var answer = $("input[name='questionOption']:checked").val();
                if (answer !== undefined) {
                    isAnswered = true;
                    var answerObj = {question_id: shuffledQuestionsArr[currQuestionIndex], user_answer: answer};
                    savedAnswers.push(answerObj);
                }

            }//end of question type validation

            if (isAnswered === true) {
                currValue += 1;
                currQuestionIndex += 1;
                updateQuizQuestion(currQuestionIndex, shuffledQuestionsArr);
                updateProgress(currValue);
            }//end of if
            else {
                $('#empty_answer_modal').modal('show');
            }//end of isAnswered validation



            if (currQuestionIndex === shuffledQuestionsArr.length) {
                function markAnswers(callback) {
                    $.ajax({
                        url: "http://localhost/Histologie/QuizPHPFiles/getQuizAnswers.php",
                        data: "quiz_id=" + quiz_id,
                        type: 'GET',
                        cache: false,
                        dataType: "JSON",
                        success: callback
                    });
                }

                markAnswers(function (response) {
                    for (var i = 0; i < response.length; i++) {
                        var question_id = response[i]['question_id'];
                        var answer = response[i]['answer'];

                        if (answer.includes(",")) {
                            answer = answer.split(",");
                        }

                        for (var ua = 0; ua < savedAnswers.length; ua++) {
                            var userQI = savedAnswers[ua]['question_id'];
                            var userA = savedAnswers[ua]['user_answer'];

                            if (question_id === userQI) {
                                if (answer === userA) {
                                    marks += 1;
                                } else if (arrayValidator(answer, userA) === true) {
                                    marks += 1;
                                    alert(userQI);
                                }

                            }//end of question validation

                        }//end of user answer for loop

                    }//end of response for loop
                    //insertStudentQuizRecord(quiz_id, marks);
                    console.log(savedAnswers);
                    console.log(response);
                    console.log(marks);
                });//end of markAnswers

                $('#quiz_end_modal').modal('show');
                /*
                 setTimeout(function () {
                 window.location.replace("http://localhost/Histologie/quizResultPage.php?quiz_id=" + quiz_id);
                 }, 2000);
                 */


            }//end of end quiz validation

        }); //end of validateAnswer

    }); //end of nextBtn



}); //end of quizLogic

function updateQuizQuestion(currQuestionIndex, shuffledQuestionsArr) {

    var url = window.location.href;
    var stuff = url.split('=');
    var quiz_id = stuff[stuff.length - 1];

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
                    }//end of length 1 MCQ
                    console.log(imgArr);
                    if (imgArr[0] === "None" && response["question_type"] === "FIB") {

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

                    }//end of length 1 without image FIB

                    else if (imgArr.length === 1 && optionsArr[0] === "0") {
                        output += "<input type='text' class='form-control mb-3' id='" + optionsArr[0] + "'placeholder ='Fill in the blank'>";
                    }//end of length 1 & 1 text field FIB

                    else if (imgArr.length === 1 && optionsArr[0] === "0" && optionsArr.length === 2) {
                        for (var i = 0; i < optionsArr.length; i++) {
                            output += "<input type='text' class='form-control mb-3' id='" + optionsArr[i] + "'placeholder ='Fill in the blank'>";
                        }//end of images for loop


                    }//end of length 1 & 2 text field FIB

                    else if (imgArr.length === 2 && optionsArr[0] === "0") {
                        output += "<div class='row'>";
                        for (var i = 0; i < imgArr.length; i++) {
                            output += "<div class='col-lg-6'>"
                                    + "<img class='img-fluid w-100 mb-3' src='css/img/quizImg/quiz" + quiz_id + "/" + imgArr[i] + "' alt='quizImage'>"
                                    + "<input type='text' class='form-control mb-3' id='" + optionsArr[i] + "'placeholder ='Fill in the blank'>"
                                    + "</div>";
                        }//end of images for loop

                        output += "</div>";
                    }//end of length 2 & 2 text field FIB

                    else if (imgArr.length === 2 && optionsArr[0] !== "0") {

                        output += "<div class='row'>";
                        for (var i = 0; i < imgArr.length; i++) {
                            output += "<div class='col-lg-6'>"
                                    + "<img class='img-fluid w-100 mb-3' src='css/img/quizImg/quiz" + quiz_id + "/" + imgArr[i] + "' alt='quizImage'>";

                            var arr = optionsArr[i].split(",");
                            output += "<div class='form-group'>"
                                    + "<select class='form-control' id= '" + i + "'>"
                                    + "<option value=''>Select Answer</option>";

                            for (var o = 0; o < arr.length; o++) {
                                output += " <option value='" + arr[o].replace("'", "&apos;") + "'>" + arr[o] + "</option>";
                            }//end of dropdown for loop
                            output += "</select></div></div>";

                        }//end of images for loop

                        output += "</div>";
                    }//end of length 2 & dropwdown FIB

                    else if (imgArr.length === 3 && optionsArr[0] !== "0") {
                        output += "<div class='row'>";
                        for (var i = 0; i < 2; i++) {
                            output += "<div class='col-lg-6'>"
                                    + "<img class='img-fluid w-100 mb-3' src='css/img/quizImg/quiz" + quiz_id + "/" + imgArr[i] + "' alt='quizImage'>";

                            var arr = optionsArr[i].split(",");
                            output += "<div class='form-group'>"
                                    + "<select class='form-control' id= '" + i + "'>"
                                    + "<option value=''>Select Answer</option>";

                            for (var o = 0; o < arr.length; o++) {
                                output += " <option value='" + arr[o].replace("'", "&apos;") + "'>" + arr[o] + "</option>";
                            }//end of dropdown for loop
                            output += "</select></div></div>";
                        }//end of images for loop

                        output += "</div><div class='row'>";
                        for (var q = 2; q < 3; q++) {
                            output += "<div class='col-lg-6'>"
                                    + "<img class='img-fluid w-100 mb-3' src='css/img/quizImg/quiz" + quiz_id + "/" + imgArr[q] + "' alt='quizImage'>";

                            var arr = optionsArr[q].split(",");
                            output += "<div class='form-group'>"
                                    + "<select class='form-control' id= '" + q + "'>"
                                    + "<option value=''>Select Answer</option>";

                            for (var p = 0; p < arr.length; p++) {
                                output += " <option value='" + arr[p].replace("'", "&apos;") + "'>" + arr[p] + "</option>";
                            }//end of dropdown for loop
                            output += "</select></div></div>";

                        }//end of images for loop

                        output += "</div>";
                    }//end of length 3 and dropdown FIB

                    else if (imgArr.length === 4 && optionsArr[0] !== "0") {
                        output += "<div class='row'>";
                        for (var i = 0; i < 2; i++) {
                            output += "<div class='col-lg-6'>"
                                    + "<img class='img-fluid w-100 mb-3' src='css/img/quizImg/quiz" + quiz_id + "/" + imgArr[i] + "' alt='quizImage'>";

                            var arr = optionsArr[i].split(",");
                            output += "<div class='form-group'>"
                                    + "<select class='form-control' id= '" + i + "'>"
                                    + "<option value=''>Select Answer</option>";

                            for (var o = 0; o < arr.length; o++) {

                                output += " <option value='" + arr[o].replace("'", "&apos;") + "'>" + arr[o] + "</option>";
                            }//end of dropdown for loop
                            output += "</select></div></div>";
                        }//end of images for loop

                        output += "</div><div class='row'>";
                        for (var q = 2; q < 4; q++) {
                            output += "<div class='col-lg-6'>"
                                    + "<img class='img-fluid w-100 mb-3' src='css/img/quizImg/quiz" + quiz_id + "/" + imgArr[q] + "' alt='quizImage'>";

                            var arr = optionsArr[q].split(",");
                            output += "<div class='form-group'>"
                                    + "<select class='form-control' id= '" + q + "'>"
                                    + "<option value=''>Select Answer</option>";

                            for (var p = 0; p < arr.length; p++) {
                                output += " <option value='" + arr[p].replace("'", "&apos;") + "'>" + arr[p] + "</option>";
                            }//end of dropdown for loop
                            output += "</select></div></div>";

                        }//end of images for loop

                        output += "</div>";
                    }//end of length 4 and dropdown FIB

                }//end of image validation 

                if (response["question_type"] === "MCQ") {
                    if (response["question_options"].length !== 0) {

                        var optionsArr = response["question_options"].split(",");
                        console.log(optionsArr);
                        for (i = 0; i < optionsArr.length; i++) {

                            output += "<div class='form-check'>"
                                    + "<input class='form-check-input' type='radio' name='questionOption' id='" + i + "'value= '" + optionsArr[i] + "'>"
                                    + "<label class='form-check-label' for=" + i + ">"
                                    + optionsArr[i]
                                    + "</label> </div>";
                        }//end of options for loop
                    }//end of options validation 

                }//end of MCQ


                $('#questionContent').html(output);
            },
            error: function (obj, textStatus, errorThrown) {
                console.log("Error " + textStatus + ": " + errorThrown);
            }
        }); //end of getQuizQuestionById
    }//end of index validation

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
                    }, 2000)
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


function arrayValidator(answerArr, userArr) {

    if (answerArr.length !== userArr.length) {
        return false;
    } else {

        for (var i = 0; i < answerArr.length; i++)
            if (answerArr[i] !== userArr[i]) {
                return false;
            }

        return true;
    }
}//end of arrayValidator

function insertStudentQuizRecord(quiz_id, marks) {
    $.ajax({
        type: "POST",
        url: "http://localhost/Histologie/QuizPHPFiles/insertStudentQuizRecord.php",
        data: "quiz_id=" + quiz_id + "&marks=" + marks,
        cache: false,
        dataType: "JSON",
        success: function (data) {
            console.log("Record Inserted");
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });

}//end of insertStudentQuizRecord



