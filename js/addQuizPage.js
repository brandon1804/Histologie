$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    addQuizLogic();

}); //end of document ready


function addQuizLogic() {

    var formData = new FormData();

//start of add quiz
    //add quiz global variables 
    var title = "";
    var summary = "";
    var categoryYN = "";
    var timeLimitYN = "";
    var quizCategory = "";
    var timeLimit = "00:00";

    $("#quizImageUpload").fileinput({
        required: true,
        maxFileCount: 1,
        maxFileSize: 0,
        validateInitialCount: true,
        allowedFileTypes: ["image"]
    });

    $("#addQuestionContent").hide();
    $('#timeLimit').hide();
    $('#quizCategorySelectContent').hide();
    $('#quizCategoryInputContent').hide();

    var selectMinutesOutput = "";
    selectMinutesOutput += "<select class='form-control' id='minutes' required='required'>"
            + "<option value=''>Minute</option>";
    for (var m = 0; m < 60; m++) {
        selectMinutesOutput += " <option value='" + m + "'>" + m + "</option>";
    }//end of minutes for loop
    selectMinutesOutput += "</select>";


    var selectSecondsOutput = "";
    selectSecondsOutput += "<select class='form-control' id='seconds' required='required'>"
            + "<option value=''>Second</option>";
    for (var m = 0; m < 60; m++) {
        selectSecondsOutput += " <option value='" + m + "'>" + m + "</option>";
    }//end of seconds for loop
    selectSecondsOutput += "</select>";
    $('#minutesSelect').html(selectMinutesOutput);
    $('#secondsSelect').html(selectSecondsOutput);

    $("input[name='timeLimitYN']").change(function () {
        if (this.value === 'Yes') {
            $('#timeLimit').show();
        } else if (this.value === 'No') {
            $('#timeLimit').hide();
        }
    }); //end of time limit radio button

    $("input[name='categoryYN']").change(function () {
        if (this.value === 'Yes') {
            $('#quizCategorySelectContent').show();
            $('#quizCategoryInputContent').hide();
        } else if (this.value === 'No') {
            $('#quizCategorySelectContent').hide();
            $('#quizCategoryInputContent').show();
        }
    }); //end of time limit radio button


    $("#addQuizForm").validate({
        rules: {
            title: {
                required: true
            },
            summary: {
                required: true
            },
            categoryYN: {
                required: true
            },
            timeLimitYN: {
                required: true
            }
        },
        messages: {
            title: {
                required: "Please enter your title"
            },
            summary: {
                required: "Please enter your summary"
            },
            categoryYN: {
                required: "Please specify whether you are using an existing category"
            },
            timeLimitYN: {
                required: "Please specify whether there is a time limit"
            }
        },
        submitHandler: function () {
            title = $("input[name='title']").val();
            summary = $("input[name='summary']").val();
            categoryYN = $("input[name='categoryYN']:checked").val();
            timeLimitYN = $("input[name='timeLimitYN']:checked").val();

            if (timeLimitYN === 'Yes') {
                var minutes = $("#minutes option:selected").val();
                var seconds = $("#seconds option:selected").val();
                if (minutes < 10) {
                    minutes = '0' + minutes;
                }
                if (seconds < 10) {
                    seconds = '0' + seconds;
                }
                timeLimit = minutes + ":" + seconds;
            }//end of timeLimit yes

            if (categoryYN === 'Yes') {
                quizCategory = $("#quizCategoryChooser option:selected").val();
                formData.append("quizImage", document.getElementById('quizImageUpload').files[0]);
                formData.append("title", title);
                formData.append("summary", summary);
                formData.append("quizCategory", quizCategory);
                formData.append("categoryYN", categoryYN);
                formData.append("timeLimit", timeLimit);

                $("#addQuizContent").hide();
                $("#addQuestionContent").show();
            }//end of quizCategory yes
            else if (categoryYN === 'No') {
                quizCategory = $("input[name='quizCategoryInput']").val();
                $.ajax({
                    type: "GET",
                    url: "AdministratorPHPFiles/getQuizCategories.php",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        var categoryExists = false;

                        for (var i = 0; i <= response.length; i++) {
                            if (quizCategory === response[i]) {
                                categoryExists = true;
                            }
                        }//end of response for loop

                        if (categoryExists === false) {
                            formData.append("quizImage", document.getElementById('quizImageUpload').files[0]);
                            formData.append("title", title);
                            formData.append("summary", summary);
                            formData.append("quizCategory", quizCategory);
                            formData.append("categoryYN", categoryYN);
                            formData.append("timeLimit", timeLimit);

                            $("#addQuizContent").hide();
                            $("#addQuestionContent").show();
                        }//end of false
                        else if (categoryExists === true) {
                            $('#category_exists_modal').modal('show');
                        }//end of true

                    }//end of success    
                });
            }//end of quizCategory no

            return false;
        }
    });//end of add quiz form validation

//end of add quiz


//start of add question

    $('#optionsCountDiv').hide();
    $('#inputsCountDiv').hide();


    //add question global variables 
    var questionObj;
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
            $('#questionOptionsTextFields').html("");
        }//end of mcq

        else if (this.value === '0') {
            questionType = "MCQ";
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
        }//end of fib

        else if (this.value === '2') {
            questionType = "FIBWO";
            $('#optionsCountDiv').show();
            $('#inputsCountDiv').show();
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


            formData.append("question", question);
            formData.append("questionScore", questionScore);
            formData.append("questionAnswer", questionAnswer);
            formData.append("questionType", questionType);

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

                formData.append("questionOption", optionsStr);
                formData.append("insertAmount", inputsCount);
            }//end of FIBWO


            $.ajax({
                url: 'AdministratorPHPFiles/addQuiz.php',
                enctype: 'multipart/form-data',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    var buttonAdd = "<a class='btn d-flex align-items-center' href='addQuizQuestionPage.php?quiz_id=" + response + "' role='button' style='background-color: #00D207; color:#fff'><i class='bx bx-sm bx-plus'></i>Add Another Question</a>";
                    $('#publish_quiz_modal .modal-footer').append(buttonAdd);
                    $('#publish_quiz_modal').modal('show');
                },
                error: function (obj, textStatus, errorThrown) {
                    console.log("Error " + textStatus + ": " + errorThrown);
                }
            });

            return false;
        }
    });//end of add question form validation
//end of add question






}//end of addQuizLogic

