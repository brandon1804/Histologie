$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    addQuestionLogic();

}); //end of document ready


function addQuestionLogic() {

    var formData = new FormData();

    var url = window.location.href;
    var stuff = url.split('=');
    var quiz_id = stuff[stuff.length - 1];


//start of add question

    $('#optionsCountDiv').hide();
    $('#inputsCountDiv').hide();
    $("#answersInfo").hide();


    //add question global variables 
    var question = "";
    var questionType = "";
    var questionScore = "";
    var questionAnswer = "";


    $("#files").fileinput({
        maxFileCount: 4,
        maxFileSize: 0,
        validateInitialCount: true,
        allowedFileTypes: ["image"]
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


    $("#addQuestionForm").validate({
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
            var totalfiles = document.getElementById('files').files.length;
            for (var index = 0; index < totalfiles; index++) {
                formData.append("files[]", document.getElementById('files').files[index]);
            }

            question = $("textarea[name='question']").val();
            questionScore = $("input[name='questionScore']").val();
            questionAnswer = $("input[name='questionAnswer']").val();

            if (question.includes("'")) {
                question = question.replace(/'/g, "\\'");
            }

            if (questionAnswer.includes("'")) {
                questionAnswer = questionAnswer.replace(/'/g, "\\'");
            }

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
                        formData.append("question", question);
                        formData.append("questionScore", questionScore);
                        formData.append("questionAnswer", questionAnswer);


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
                            url: 'AdministratorPHPFiles/addQuizQuestion.php',
                            enctype: 'multipart/form-data',
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                var buttonAdd = "<a class='btn d-flex align-items-center' href='addQuizQuestionPage.php?quiz_id=" + response + "' role='button' style='background-color: #00D207; color:#fff'><i class='bx bx-sm bx-plus'></i>Add Another Question</a>";
                                $('#publish_question_modal .modal-footer').append(buttonAdd);
                                $('#publish_question_modal').modal('show');
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



            //$('#addQuestionForm')[0].reset();
            //$('#inputsCountDiv').hide();
            //$('#optionsCountDiv').hide();
            //$('#questionOptionsTextFields').html("");
            //$('#publish_quiz_modal').modal('show');

            return false;
        }
    });//end of add question form validation
//end of add question



}//end of addQuestionLogic

