$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    editQuestionLogic();

}); //end of document ready


function editQuestionLogic() {

    var formData = new FormData();

    var quiz_id = $('#quizId').html();
    var question_id = $('#questionId').html();


    $('#optionsCountDiv').hide();
    $('#inputsCountDiv').hide();
    $("#answersInfo").hide();


    //edit question global variables 
    var question = "";
    var questionType = "";
    var questionScore = "";
    var questionAnswer = "";
    var imageChanged = "No";
    var questionChanged = "No";


    $.ajax({
        type: "GET",
        url: "AdministratorPHPFiles/getQuizQuestion.php",
        data: "quiz_id=" + quiz_id + "&question_id=" + question_id,
        cache: false,
        dataType: "JSON",
        success: function (response) {

            let images = [];
            let imageNames = [];

            if (response['images'][0] !== "None") {
                for (var i = 0; i < response['images'].length; i++) {
                    images.push("css/img/quizImg/quiz" + quiz_id + "/" + response['images'][i]);
                    imageNames.push({caption: response['images'][i]});
                }//end of for loop
            }


            $("#files").fileinput({
                maxFileCount: 4,
                showRemove: true,
                showClose: false,
                initialPreviewShowDelete: false,
                overwriteInitial: true,
                validateInitialCount: true,
                initialPreview: images,
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: imageNames
            });

            $("textarea[name='question']").val(response['question']);

            if (response['question_type'] === "MCQ") {
                //hasOptions = true;
                $("#questionType").val("0").change();
                $('#optionsCountDiv').show();
                var optionsArr = response['question_options'].split(",");
                var optionAmount = optionsArr.length;
                var optionOutput = "";
                $("#optionsCount").val(optionAmount).change();
                for (var i = 0; i < optionAmount; i++) {
                    optionOutput += "<div class='form-group'>"
                            + "<label for='question'>Option " + (i + 1) + "</label>"
                            + "<input type='text' class='form-control uniqueOption' name='questionOption" + i + "'placeholder ='Enter option' required='required'></div>";
                }//end of for loop

                $('#questionOptionsTextFields').html(optionOutput);

                for (var i = 0; i < optionAmount; i++) {
                    $("input[name='questionOption" + i + "']").val(optionsArr[i]);
                }//end of for loop
            }//end of mcq


            else if (response['question_type'] === "FIB" && response['question_options'][0] === "0") {
                $("#questionType").val("1").change();
                var inputs = response['question_options'].length;
                $("#inputsCount").val(inputs).change();
            }//end of fib


            else if (response['question_type'] === "FIB" && response['question_options'][0] !== "0") {
                //hasOptions = true;
                $("#questionType").val("2").change();
                $('#optionsCountDiv').show();
                $('#inputsCountDiv').show();
                var inputs = response['question_options'].length;
                $("#inputsCount").val(inputs).change();
                if (inputs >= 2) {
                    $("#answersInfo").show();
                }
                var optionsArr = response['question_options'][0].split(',');
                var optionAmount = optionsArr.length;
                var optionOutput = "";
                $("#optionsCount").val(optionAmount).change();
                for (var i = 0; i < optionAmount; i++) {
                    optionOutput += "<div class='form-group'>"
                            + "<label for='question'>Option " + (i + 1) + "</label>"
                            + "<input type='text' class='form-control uniqueOption' name='questionOption" + i + "'placeholder ='Enter option' required='required'></div>";
                }//end of for loop

                $('#questionOptionsTextFields').html(optionOutput);

                for (var i = 0; i < optionAmount; i++) {
                    $("input[name='questionOption" + i + "']").val(optionsArr[i]);
                }//end of for loop
            }//end of dropdown


            $("input[name='questionScore']").val(response['question_score']);
            $("input[name='questionAnswer']").val(response['answer']);

        }//end of success    
    });

    $("#questionType").change(function () {
        if (this.value === '') {
            $('#inputsCountDiv').hide();
            $('#optionsCountDiv').hide();
            $("#answersInfo").hide();
            $('#questionOptionsTextFields').html("");
        }//end of mcq

        else if (this.value === '0') {
            questionType = "MCQ";
            $("#answersInfo").hide();
            $('#inputsCountDiv').hide();
            $('#optionsCountDiv').show();
            var optionAmount = $("#optionsCount option:selected").val();
            var optionOutput = "";
            for (var i = 0; i < optionAmount; i++) {
                optionOutput += "<div class='form-group'>"
                        + "<label for='question'>Option " + (i + 1) + "</label>"
                        + "<input type='text' class='form-control uniqueOption' name='questionOption" + i + "'placeholder ='Enter option' required='required'></div>";
            }//end of for loop

            $('#questionOptionsTextFields').html(optionOutput);
        }//end of mcq

        else if (this.value === '1') {
            questionType = "FIB";
            $('#optionsCountDiv').hide();
            $('#questionOptionsTextFields').html("");
            $('#inputsCountDiv').show();

            var inputsAmount = $("#inputsCount option:selected").val();
            if (inputsAmount >= 2) {
                $("#answersInfo").show();
            }
        }//end of fib

        else if (this.value === '2') {
            questionType = "FIBWO";
            $('#optionsCountDiv').show();
            $('#inputsCountDiv').show();

            var inputsAmount = $("#inputsCount option:selected").val();
            if (inputsAmount >= 2) {
                $("#answersInfo").show();
            }

            var optionAmount = $("#optionsCount option:selected").val();
            var optionOutput = "";
            for (var i = 0; i < optionAmount; i++) {
                optionOutput += "<div class='form-group'>"
                        + "<label for='question'>Option " + (i + 1) + "</label>"
                        + "<input type='text' class='form-control uniqueOption' name='questionOption" + i + "'placeholder ='Enter option' required='required'></div>";
            }//end of for loop

            $('#questionOptionsTextFields').html(optionOutput);
        }//end of dropdown

    }); //end of question type


    $("#optionsCount").change(function () {
        var output = "";
        var optionAmount = this.value;
        for (var i = 0; i < optionAmount; i++) {
            output += "<div class='form-group'>"
                    + "<label for='question'>Option " + (i + 1) + "</label>"
                    + "<input type='text' class='form-control uniqueOption' name='questionOption" + i + "'placeholder ='Enter option' required='required'></div>";
        }//end of for loop
        $('#questionOptionsTextFields').html(output);
    }); //end of optionsCount

    $("#inputsCount").change(function () {
        if (this.value >= 2) {
            $("#answersInfo").show();
        } else {
            $("#answersInfo").hide();
        }
    }); //end of inputsCount

    $.validator.addMethod("uniqueOption", function (value, element) {
        var parentForm = $(element).closest('form');
        var timeRepeated = 0;
        if (value !== '') {
            $(parentForm.find('#questionOptionsTextFields :text')).each(function () {
                if ($(this).val() === value) {
                    timeRepeated++;
                }
            });
        }
        return timeRepeated === 1 || timeRepeated === 0;

    }, "Duplicate options are not allowed");


    $('#files').on('fileclear', function (event) {
        imageChanged = "Yes";
    });

    $("#files").change(function () {
        imageChanged = "Yes";
    });

    $("textarea[name='question']").change(function () {
        questionChanged = "Yes";
    });




    $("#editQuestionForm").validate({
        rules: {
            question: {
                required: true
            },
            questionTypeSelect: {
                required: true
            },
            questionScore: {
                required: true,
                pattern: /^[0-9]*$/
            },
            questionAnswer: {
                required: true
            }
        },
        messages: {
            question: {
                required: "Please enter the question"
            },
            questionTypeSelect: {
                required: "Please indicate the question's type"
            },
            questionScore: {
                required: "Please enter the question's score",
                pattern: "Only numbers are allowed"
            },
            questionAnswer: {
                required: "Please enter the question's answer(s)"
            }
        },
        submitHandler: function () {

            if (imageChanged === "Yes") {
                var totalfiles = document.getElementById('files').files.length;
                for (var index = 0; index < totalfiles; index++) {
                    formData.append("files[]", document.getElementById('files').files[index]);
                }
            }//end of image changes

            question = $("textarea[name='question']").val();
            questionScore = $("input[name='questionScore']").val();
            questionAnswer = $("input[name='questionAnswer']").val();

            if (question.includes("'")) {
                question = question.replace(/'/g, "\\'");
            }

            if (questionAnswer.includes("'")) {
                questionAnswer = questionAnswer.replace(/'/g, "\\'");
            }


            if (questionChanged === "Yes") {
                $.ajax({
                    type: "GET",
                    url: "AdministratorPHPFiles/getQuizQuestions.php",
                    data: "quiz_id=" + quiz_id,
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        var qExists = false;

                        for (var i = 0; i <= response.length; i++) {
                            if (question === response[i]) {
                                qExists = true;
                            }
                        }//end of response for loop

                        if (qExists === false) {
                            formData.append("quiz_id", quiz_id);
                            formData.append("question_id", question_id);
                            formData.append("question", question);
                            formData.append("questionScore", questionScore);
                            formData.append("questionAnswer", questionAnswer);
                            formData.append("imageChanged", imageChanged);



                            if (questionType === 'MCQ') {
                                var optionsCount = $("#optionsCount option:selected").val();
                                var optionsStr = "";

                                for (var i = 0; i < optionsCount; i++) {
                                    if (i === 0) {
                                        optionsStr += ($("input[name='questionOption" + i + "']").val());
                                    } else if (i !== 0) {
                                        optionsStr += ("," + $("input[name='questionOption" + i + "']").val());
                                    }
                                }//end of options for loop

                                if (optionsStr.includes("'")) {
                                    optionsStr = optionsStr.replace(/'/g, "\\'");
                                }
                                formData.append("questionType", questionType);
                                formData.append("questionOption", optionsStr);
                                formData.append("insertAmount", 1);
                            }//end of mcq

                            else if (questionType === 'FIB') {
                                var inputsCount = $("#inputsCount option:selected").val();
                                var optionsStr = "";
                                for (var i = 0; i < inputsCount; i++) {
                                    if (i === 0) {
                                        optionsStr += "0";
                                    } else if (i !== 0) {
                                        optionsStr += ("," + i);
                                    }
                                }//end of options for loop

                                if (optionsStr.includes("'")) {
                                    optionsStr = optionsStr.replace(/'/g, "\\'");
                                }

                                formData.append("questionType", questionType);
                                formData.append("questionOption", optionsStr);
                                formData.append("insertAmount", inputsCount);

                            }//end of FIB

                            else if (questionType === 'FIBWO') {
                                questionType = "FIB";

                                var inputsCount = $("#inputsCount option:selected").val();
                                var optionsCount = $("#optionsCount option:selected").val();
                                var optionsStr = "";


                                for (var i = 0; i < optionsCount; i++) {
                                    if (i === 0) {
                                        optionsStr += ($("input[name='questionOption" + i + "']").val());
                                    } else if (i !== 0) {
                                        optionsStr += ("," + $("input[name='questionOption" + i + "']").val());
                                    }
                                }//end of options for loop


                                if (optionsStr.includes("'")) {
                                    optionsStr = optionsStr.replace(/'/g, "\\'");
                                }


                                formData.append("questionType", questionType);
                                formData.append("questionOption", optionsStr);
                                formData.append("insertAmount", inputsCount);
                            }//end of FIBWO


                            $.ajax({
                                url: 'AdministratorPHPFiles/editQuizQuestion.php',
                                enctype: 'multipart/form-data',
                                type: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    $('#editing_done_modal').modal('show');
                                    setTimeout(function () {
                                        window.location.replace("manageQuizPage.php?quiz_id=" + response);
                                    }, 1500);
                                },
                                error: function (obj, textStatus, errorThrown) {
                                    console.log("Error " + textStatus + ": " + errorThrown);
                                }
                            });

                        }//end of false
                        else if (qExists === true) {
                            $('#question_exists_modal').modal('show');
                        }//end of true

                    }//end of success    
                });//end of getQuizQuestions
            }//end of question changed

            else {
                formData.append("quiz_id", quiz_id);
                formData.append("question_id", question_id);
                formData.append("question", question);
                formData.append("questionScore", questionScore);
                formData.append("questionAnswer", questionAnswer);
                formData.append("imageChanged", imageChanged);


                if (questionType === 'MCQ') {
                    var optionsCount = $("#optionsCount option:selected").val();
                    var optionsStr = "";

                    for (var i = 0; i < optionsCount; i++) {
                        if (i === 0) {
                            optionsStr += ($("input[name='questionOption" + i + "']").val());
                        } else if (i !== 0) {
                            optionsStr += ("," + $("input[name='questionOption" + i + "']").val());
                        }
                    }//end of options for loop

                    if (optionsStr.includes("'")) {
                        optionsStr = optionsStr.replace(/'/g, "\\'");
                    }
                    formData.append("questionType", questionType);
                    formData.append("questionOption", optionsStr);
                    formData.append("insertAmount", 1);
                }//end of mcq

                else if (questionType === 'FIB') {
                    var inputsCount = $("#inputsCount option:selected").val();
                    var optionsStr = "";
                    for (var i = 0; i < inputsCount; i++) {
                        if (i === 0) {
                            optionsStr += "0";
                        } else if (i !== 0) {
                            optionsStr += ("," + i);
                        }
                    }//end of options for loop

                    if (optionsStr.includes("'")) {
                        optionsStr = optionsStr.replace(/'/g, "\\'");
                    }

                    formData.append("questionType", questionType);
                    formData.append("questionOption", optionsStr);
                    formData.append("insertAmount", inputsCount);

                }//end of FIB

                else if (questionType === 'FIBWO') {
                    questionType = "FIB";

                    var inputsCount = $("#inputsCount option:selected").val();
                    var optionsCount = $("#optionsCount option:selected").val();
                    var optionsStr = "";


                    for (var i = 0; i < optionsCount; i++) {
                        if (i === 0) {
                            optionsStr += ($("input[name='questionOption" + i + "']").val());
                        } else if (i !== 0) {
                            optionsStr += ("," + $("input[name='questionOption" + i + "']").val());
                        }
                    }//end of options for loop


                    if (optionsStr.includes("'")) {
                        optionsStr = optionsStr.replace(/'/g, "\\'");
                    }


                    formData.append("questionType", questionType);
                    formData.append("questionOption", optionsStr);
                    formData.append("insertAmount", inputsCount);
                }//end of FIBWO


                $.ajax({
                    url: 'AdministratorPHPFiles/editQuizQuestion.php',
                    enctype: 'multipart/form-data',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('#editing_done_modal').modal('show');
                        setTimeout(function () {
                            window.location.replace("manageQuizPage.php?quiz_id=" + response);
                        }, 1500);
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });
            }//end of question not changed





            //$('#addQuestionForm')[0].reset();
            //$('#inputsCountDiv').hide();
            //$('#optionsCountDiv').hide();
            //$('#questionOptionsTextFields').html("");
            //$('#publish_quiz_modal').modal('show');

            return false;
        }
    });//end of edit question form validation




}//end of editQuestionLogic

