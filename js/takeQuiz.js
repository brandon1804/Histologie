$(document).ready(function () {


    quizLogic();

}); //end of document ready



function quizLogic(callback) {
    var url = window.location.href;
    var stuff = url.split('=');
    var quiz_id = stuff[stuff.length - 1];

    $.ajax({
        url: "QuizPHPFiles/getQuizQuestions.php",
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
    var questionType = "";

    let shuffledQuestionsArr = shuffleQuestions(response);
    console.log(shuffledQuestionsArr);
    updateQuizQuestion(currQuestionIndex, shuffledQuestionsArr);
    updateProgress(currValue);

    $("#nextBtn").click(function () {
        function validateAnswer(callback) {
            $.ajax({
                type: "GET",
                url: "QuizPHPFiles/getQuizQuestionById.php",
                data: "quiz_id=" + quiz_id + "&question_id=" + shuffledQuestionsArr[currQuestionIndex],
                cache: false,
                dataType: "JSON",
                success: callback
            });
        }
        validateAnswer(function (response) {

            questionType = response["question_type"];
            var isAnswered = false;
            if (response["images"].length !== 0) {
                var imgArr = response["images"];
                var optionsArr = response["question_options"];

                if (imgArr[0] === "None" && response["question_type"] === "FIB") {
                    var answersArr = [];
                    for (var i = 0; i < optionsArr.length; i++) {
                        answersArr.push($("#" + i + " option:selected").val());
                    }//end of options for loop

                    if (answersArr.length === optionsArr.length && !answersArr.includes("")) {
                        isAnswered = true;
                        var answerObj = {question_id: shuffledQuestionsArr[currQuestionIndex], user_answer: answersArr};
                        savedAnswers.push(answerObj);
                    }
                }//end of no image & dropdown option more than 1


                else if (imgArr.length === 1 && optionsArr[0] === "0" && optionsArr.length === 1) {
                    if ($("#0").val() !== "") {
                        var answer = ($("#0").val());
                        isAnswered = true;
                        var answerObj = {question_id: shuffledQuestionsArr[currQuestionIndex], user_answer: answer};
                        savedAnswers.push(answerObj);
                    }
                }//end of length 1 & 1 FIB text field 

                else if (imgArr.length === 1 && optionsArr[0] === "0" && optionsArr.length > 1) {
                    var answersArr = [];
                    for (var i = 0; i < optionsArr.length; i++) {
                        answersArr.push($("#" + i).val());
                    }//end of options for loop

                    if (answersArr.length === optionsArr.length && !answersArr.includes("")) {
                        isAnswered = true;
                        var answerObj = {question_id: shuffledQuestionsArr[currQuestionIndex], user_answer: answersArr};
                        savedAnswers.push(answerObj);
                    }

                }//end of length 1  && 2 FIB text field


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

                }//end of length 2  && FIB text field

                else if (imgArr.length === 1 && optionsArr[0] !== "0" && optionsArr.length === 2) {
                    var answersArr = [];
                    for (var i = 0; i < optionsArr.length; i++) {
                        answersArr.push($("#" + i + " option:selected").val());
                    }//end of options for loop

                    if (answersArr.length === optionsArr.length && !answersArr.includes("")) {
                        isAnswered = true;
                        var answerObj = {question_id: shuffledQuestionsArr[currQuestionIndex], user_answer: answersArr};
                        savedAnswers.push(answerObj);
                    }
                } //end of length 1  && 2 FIB dropdown


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

                }//end of length more than 2 && FIB dropdown
            }//end of image validation 

            if (response["question_type"] === "MCQ") {
                var answer = $("input[name='questionOption']:checked").val();

                if (answer !== undefined) {
                    isAnswered = true;
                    var answerObj = {question_id: shuffledQuestionsArr[currQuestionIndex], user_answer: answer};
                    savedAnswers.push(answerObj);
                }

            }//end of MCQ validation

            if (response["question_type"] === "M&M") {
                var aArr = [];

                for (var i = 0; i < 2; i++) {
                    aArr.push($("#" + i).val());
                }//end of options for loop
                var answersArr = aArr[0].concat(aArr[1]);
                console.log(answersArr);
                if (answersArr.length === 4 && !answersArr.includes("")) {
                    isAnswered = true;
                    var answerObj = {question_id: shuffledQuestionsArr[currQuestionIndex], user_answer: answersArr};
                    savedAnswers.push(answerObj);
                }

            }//end of mix and match

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
                        url: "QuizPHPFiles/getQuizAnswers.php",
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
                        var marksAllocated = parseInt(response[i]['question_score']);


                        if (answer.includes(",")) {
                            answer = answer.split(",");
                        }



                        for (var ua = 0; ua < savedAnswers.length; ua++) {
                            var userQI = savedAnswers[ua]['question_id'];
                            var userA = savedAnswers[ua]['user_answer'];

                            if (question_id === userQI) {
                                if (answer === userA) {
                                    marks += marksAllocated;
                                }//end of mcq/single text field validation 
                                else if (arrayValidator(answer, userA) === true) {
                                    marks += marksAllocated;
                                }//full marks for arrays

                                else if (arrayValidator(answer, userA) === false && questionType !== "M&M") {
                                    for (var a = 0; a < answer.length; a++) {
                                        if (answer[a] === userA[a]) {
                                            marks += 1;
                                        }
                                    }//end of answer for loop
                                }//end of per option 

                                else if (arrayValidator(answer, userA) === false && questionType === "M&M") {
                                    for (var a = 0; a < answer.length; a++) {
                                        if (answer[a] === userA[a]) {
                                            marks += 0.5;
                                        }
                                    }//end of answer for loop
                                }//end of per option 

                            }//end of question validation

                        }//end of user answer for loop

                    }//end of response for loop

                    console.log(response);
                    console.log(savedAnswers);
                    console.log(marks);
                    insertStudentQuizRecord(quiz_id, marks);

                });//end of markAnswers

                $('#quizTimer').hide;
                $('#quiz_end_modal').modal('show');

                setTimeout(function () {
                    window.location.replace("quizResultPage.php?quiz_id=" + quiz_id);
                }, 2000);




            }//end of end quiz validation

        }); //end of validateAnswer

    }); //end of nextBtn


//Update Quiz Page and Times Up validation
    $.ajax({
        type: "GET",
        url: "QuizPHPFiles/getQuizDetails.php",
        data: "id=" + quiz_id,
        cache: false,
        dataType: "JSON",
        success: function (response) {

            $('#quizTitle').html(response["title"]);
            var quizTime = response["duration"];

            if (quizTime !== "00:00") {
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
                        function markAnswers(callback) {
                            $.ajax({
                                url: "QuizPHPFiles/getQuizAnswers.php",
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
                                var marksAllocated = parseInt(response[i]['question_score']);


                                if (answer.includes(",")) {
                                    answer = answer.split(",");
                                }



                                for (var ua = 0; ua < savedAnswers.length; ua++) {
                                    var userQI = savedAnswers[ua]['question_id'];
                                    var userA = savedAnswers[ua]['user_answer'];

                                    if (question_id === userQI) {
                                        if (answer === userA) {
                                            marks += marksAllocated;
                                        }//end of mcq/single text field validation 
                                        else if (arrayValidator(answer, userA) === true) {
                                            marks += marksAllocated;
                                        }//full marks for arrays

                                        else if (arrayValidator(answer, userA) === false && questionType !== "M&M") {
                                            for (var a = 0; a < answer.length; a++) {
                                                if (answer[a] === userA[a]) {
                                                    marks += 1;
                                                }
                                            }//end of answer for loop
                                        }//end of per option 

                                        else if (arrayValidator(answer, userA) === false && questionType === "M&M") {
                                            for (var a = 0; a < answer.length; a++) {
                                                if (answer[a] === userA[a]) {
                                                    marks += 0.5;
                                                }
                                            }//end of answer for loop
                                        }//end of per option 

                                    }//end of question validation

                                }//end of user answer for loop

                            }//end of response for loop
                            //console.log(response);
                            //console.log(savedAnswers);
                            //console.log(marks);
                            insertStudentQuizRecord(quiz_id, marks);

                        });//end of markAnswers

                        clearInterval(interval);
                        $('#times_up_modal').modal('show');
                        setTimeout(function () {
                            window.location.replace("quizResultPage.php?quiz_id=" + quiz_id);
                        }, 2000);
                    }//end of times up

                    quizTime = minutes + ':' + seconds;
                }, 1000);
            }//end of timer validation
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });



}); //end of quizLogic

function updateQuizQuestion(currQuestionIndex, shuffledQuestionsArr) {

    var url = window.location.href;
    var stuff = url.split('=');
    var quiz_id = stuff[stuff.length - 1];

    if (currQuestionIndex < shuffledQuestionsArr.length) {
        $.ajax({
            type: "GET",
            url: "QuizPHPFiles/getQuizQuestionById.php",
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

                    if (imgArr[0] === "None" && response["question_type"] === "FIB") {
                        for (var t = 0; t < optionsArr.length; t++) {

                            var arr = optionsArr[t].split(",");
                            output += "<div class='form-group'>"
                                    + "<label for='" + t + "'>Blank " + (t + 1) + "</label>"
                                    + "<select class='form-control' id= '" + t + "'>"
                                    + "<option value=''>Select Answer</option>";
                            for (var i = 0; i < arr.length; i++) {
                                output += " <option value='" + arr[i] + "'>" + arr[i] + "</option>";
                            }//end of dropdown for loop
                            output += "</select></div>";
                        }//end of options for loop

                    }//end of length 1 without image FIB

                    else if (imgArr.length === 1 && optionsArr[0] === "0" && optionsArr.length === 1) {
                        output += "<input type='text' class='form-control mb-3' id='0' placeholder ='Fill in the blank'>";
                    }//end of length 1 & 1 text field FIB

                    else if (imgArr.length === 1 && optionsArr[0] === "0" && optionsArr.length > 1) {
                        for (var i = 0; i < optionsArr.length; i++) {
                            output += "<input type='text' class='form-control mb-3' id='" + optionsArr[i] + "'placeholder ='Fill in the blank'>";
                        }//end of images for loop

                    }//end of length 1 & more than 1 text field FIB

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

                    else if (imgArr.length === 1 && optionsArr[0] !== "0" && optionsArr.length === 2) {

                        for (var t = 0; t < optionsArr.length; t++) {

                            var arr = optionsArr[t].split(",");
                            output += "<div class='form-group'>"
                                    + "<label for='" + t + "'>Blank " + (t + 1) + "</label>"
                                    + "<select class='form-control' id= '" + t + "'>"
                                    + "<option value=''>Select Answer</option>";
                            for (var i = 0; i < arr.length; i++) {
                                output += " <option value='" + arr[i] + "'>" + arr[i] + "</option>";
                            }//end of dropdown for loop
                            output += "</select></div>";
                        }//end of options for loop
                    }//end of length 1 & 2 dropwdown FIB

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
                        for (i = 0; i < optionsArr.length; i++) {
                            output += "<div class='form-check'>"
                                    + "<input class='form-check-input' type='radio' name='questionOption' id='" + i + "'value= '" + optionsArr[i].replace("'", "&apos;") + "'>"
                                    + "<label class='form-check-label' for=" + i + ">"
                                    + optionsArr[i]
                                    + "</label> </div>";
                        }//end of options for loop
                    }//end of options validation 

                }//end of MCQ



                if (response["question_type"] === "M&M") {
                    var arr = optionsArr[0].split(",");
                    for (var t = 0; t < 2; t++) {
                        output += "<div class='form-group'>"
                                + "<label for='" + t + "'>" + arr[t] + "--Cellular Component--Colour of stain" + "</label>"
                                + "<select multiple class='form-control mb-2' id= '" + t + "'>"
                                + "<option value=''>Select Cellular Component & Colour of stain</option>";
                        for (var i = 2; i < arr.length; i++) {
                            output += " <option value='" + arr[i] + "'>" + arr[i] + "</option>";
                        }//end of dropdown for loop

                        output += "</select></div>";
                    }//end of options for loop

                }//end of mix and match



                $('#questionContent').html(output);
            },
            error: function (obj, textStatus, errorThrown) {
                console.log("Error " + textStatus + ": " + errorThrown);
            }
        }); //end of getQuizQuestionById
    }//end of index validation

}//end of updateQuizQuestion




function updateProgress(currValue) {

    var url = window.location.href;
    var stuff = url.split('=');
    var quiz_id = stuff[stuff.length - 1];
    $.ajax({
        type: "GET",
        url: "QuizPHPFiles/getQuizDetails.php",
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
        url: "QuizPHPFiles/insertStudentQuizRecord.php",
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



