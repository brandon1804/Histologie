$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    editQuizLogic();

}); //end of document ready


function editQuizLogic() {

    var formData = new FormData();

    var url = window.location.href;
    var stuff = url.split('=');
    var quiz_id = stuff[stuff.length - 1];

    $("#imageName").hide();
    //add quiz global variables 
    var title = "";
    var summary = "";
    var categoryYN = "";
    var timeLimitYN = "";
    var quizCategory = "";
    var timeLimit = "00:00";
    var imageChanged = "No";


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


    let imagePath = "css/img/quizImg/" + $("#imageName").html();

    $("#quizImageUpload").fileinput({
        maxFileCount: 1,
        showRemove: false,
        showClose: false,
        initialPreviewShowDelete: false,
        overwriteInitial: true,
        validateInitialCount: true,
        initialPreview: [
            imagePath
        ],
        initialPreviewAsData: true,
        initialPreviewFileType: 'image',
        initialPreviewConfig: [
            {caption: $("#imageName").html()}
        ]
    });


    $.ajax({
        type: "GET",
        url: "AdministratorPHPFiles/getQuizDetails.php",
        data: "quiz_id=" + quiz_id,
        cache: false,
        dataType: "JSON",
        success: function (response) {

            $("#quizTitle").html("Edit " + response['title'] + " Quiz");
            $("input[name='title']").val(response['title']);
            $("input[name='summary']").val(response['summary']);


            if (response['duration'] !== "00:00") {
                $("#timeLimitY").prop("checked", true);
                $('#timeLimit').show();

                var durationSplit = response['duration'].split(":");
                $("#minutes").val(durationSplit[0]).change();

                if (parseInt(durationSplit[1]) < 10) {
                    $("#seconds").val(durationSplit[1].substring(0, 1)).change();
                } else {
                    $("#seconds").val(durationSplit[1]).change();
                }

            } else {
                $("#timeLimitN").prop("checked", true);
                $('#timeLimit').hide();
            }//end of time validation

            $('#quizCategorySelectContent').show();
            $("#categoryY").prop("checked", true);
            $("#quizCategoryChooser").val(response['quizcategory_id']).change();



        }//end of success    
    });



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

    $('#quizImageUpload').on('change', function () {
        imageChanged = "Yes";
    });

    $("#editQuizForm").validate({
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
                if (imageChanged === "Yes") {
                    formData.append("quizImage", document.getElementById('quizImageUpload').files[0]);
                }
                formData.append("imageChanged", imageChanged);
                formData.append("quiz_id", quiz_id);
                formData.append("title", title);
                formData.append("summary", summary);
                formData.append("quizCategory", quizCategory);
                formData.append("categoryYN", categoryYN);
                formData.append("timeLimit", timeLimit);


                $.ajax({
                    url: 'AdministratorPHPFiles/editQuiz.php',
                    enctype: 'multipart/form-data',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('#editing_done_modal').modal('show');
                        setTimeout(function () {
                            window.location.href = "manageQuizzes.php";
                        }, 1500);
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });

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
                            if (imageChanged === "Yes") {
                                formData.append("quizImage", document.getElementById('quizImageUpload').files[0]);
                            }
                            formData.append("imageChanged", imageChanged);
                            formData.append("quiz_id", quiz_id);
                            formData.append("title", title);
                            formData.append("summary", summary);
                            formData.append("quizCategory", quizCategory);
                            formData.append("categoryYN", categoryYN);
                            formData.append("timeLimit", timeLimit);

                            $.ajax({
                                url: 'AdministratorPHPFiles/editQuiz.php',
                                enctype: 'multipart/form-data',
                                type: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    $('#editing_done_modal').modal('show');
                                    setTimeout(function () {
                                        window.location.href = "manageQuizzes.php";
                                    }, 1500);
                                },
                                error: function (obj, textStatus, errorThrown) {
                                    console.log("Error " + textStatus + ": " + errorThrown);
                                }
                            });


                        }//end of false
                        else if (categoryExists === true) {
                            $('#category_exists_modal').modal('show');
                        }//end of true

                    }//end of success    
                });
            }//end of quizCategory no

            return false;
        }
    });//end of edit quiz form validation



}//end of editQuizLogic

