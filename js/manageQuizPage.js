$(document).ready(function () {

    var url = window.location.href;
    var stuff = url.split('=');
    var quiz_id = stuff[stuff.length - 1];


    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    updateManageQuizPage();
    reload_table();



    $("#questionsTable").on("click", ".btnEdit", function () {
        var id = $(this).val();
        window.location.href = "editQuizQuestionPage.php?quiz_id=" + quiz_id + "&question_id=" + id;
    });//end of edit question

    $("#questionsTable").on("click", ".btnDelete", function () {
        var id = $(this).val();

        $("#delete_question_modal").modal('show');
        $("#delete_question_modal .btnDeleteQuestion").on("click", function () {
            $.ajax({
                type: "GET",
                url: "AdministratorPHPFiles/deleteQuizQuestion.php",
                cache: false,
                data: "question_id=" + id + "&quiz_id=" + quiz_id,
                dataType: "JSON",
                success: function (response) {
                    if(response === true){
                        reload_table();
                        $("#delete_question_modal").modal('hide');
                    }
                    else if(response === false){
                        $("#delete_question_modal").modal('hide');
                        $("#question_validation_modal").modal('show');
                    } 
                 
                },
                error: function (obj, textStatus, errorThrown) {
                    console.log("Error " + textStatus + ": " + errorThrown);
                }
            });
        });//end of result true

    });//end of delete question



    $(".addQuestionBtn").on("click", function () {
        window.location.href = "addQuizQuestionPage.php?quiz_id=" + quiz_id;
    });

    $(".editQuizBtn").on("click", function () {
        window.location.href = "editQuizPage.php?quiz_id=" + quiz_id;
    });

    $(".deleteQuizBtn").on("click", function () {
        $('#delete_quiz_modal').modal('show');

        $("#delete_quiz_modal .modalBtnDeleteQuiz").on("click", function () {
            $.ajax({
                type: "GET",
                url: "AdministratorPHPFiles/deleteQuiz.php",
                cache: false,
                data: "quiz_id=" + quiz_id,
                dataType: "JSON",
                success: function (response) {
                    if (response.message === "Success") {
                        $('#quiz_deleted_modal').modal('show');
                        setTimeout(function () {
                            window.location.href = "manageQuizzes.php";
                        }, 2000);
                    }//end of success                   
                },
                error: function (obj, textStatus, errorThrown) {
                    console.log("Error " + textStatus + ": " + errorThrown);
                }
            });
        });
    });

}); //end of document ready


function updateManageQuizPage() {
    var url = window.location.href;
    var stuff = url.split('=');
    var quiz_id = stuff[stuff.length - 1];



    $.ajax({
        type: "GET",
        url: "AdministratorPHPFiles/getQuizTitle.php",
        data: "quiz_id=" + quiz_id,
        cache: false,
        dataType: "JSON",
        success: function (response) {

            $("#quizTitle").html("Manage " + response['title'] + " Quiz");

        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}//end of updateQuizLandingPage


function reload_table() {
    var url = window.location.href;
    var stuff = url.split('=');
    var quiz_id = stuff[stuff.length - 1];

    $.ajax({
        type: "GET",
        url: "AdministratorPHPFiles/getQuestionsByQuizId.php",
        data: "quiz_id=" + quiz_id,
        cache: false,
        dataType: "JSON",
        success: function (response) {
            var message = "";
            var students = [];
            for (i = 0; i < response.length; i++) {
                message += "<tr><td>" + response[i].question + "</td>"
                        + "<td>" + response[i].question_type + "</td>"
                        + "<td>" + response[i].question_score + "</td>"
                        + "<td>" + response[i].answer + "</td>"
                        + "<td><button class='btnEdit btn btn-primary mb-2' value='" + response[i].question_id + "'><i class='bx bx-pencil'></i>Edit</button>&nbsp;&nbsp;"
                        + "<button class='btnDelete btn btn-danger' value='" + response[i].question_id + "'><i class='bx bx-trash-alt'></i>Delete</button></td>"
                        + "</tr>";
            }

            $("#questionsTable tbody").html(message);
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}//end of reload_table


