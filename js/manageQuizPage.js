$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
    updateManageQuizPage();
    reload_table();

}); //end of document ready


function updateManageQuizPage() {
    var url = window.location.href;
    var stuff = url.split('=');
    var quiz_id = stuff[stuff.length - 1];



    $.ajax({
        type: "GET",
        url: "http://localhost/Histologie/AdministratorPHPFiles/getManageQuizDetails.php",
        data: "quiz_id=" + quiz_id,
        cache: false,
        dataType: "JSON",
        success: function (response) {
            var students = response['students'];
            var completed = response['quizzesCompleted']



            $("#quizTitle").html(response['title'] + " Quiz");

            var completedPercentage = (completed / students) * 100;
            $(".circlechartSC").attr("data-percentage", Math.round(completedPercentage));
            $(".circlechartSC").text(students + " / " + completed);

            $('.circlechartSC').circlechart();
            $("#scText").text(students + " out of " + completed + " students have completed this quiz.");

            var avgScore = response['average_score'];
            var quizScore = response['score'];
            var avgPercentage = (avgScore / quizScore) * 100;
            $(".circlechartAS").attr("data-percentage", Math.round(avgPercentage));
            $(".circlechartAS").text(Math.round(avgScore) + " / " + quizScore);

            $('.circlechartAS').circlechart();
            $("#asText").text("The average score for this quiz is " + Math.round(avgScore) + " / " + quizScore + ".");

            var tsScore = response['highest_score'];
            var tsPercentage = (tsScore / quizScore) * 100;
            var topScorer = response['top_scorer_name'];
            var studentID = response['student_id'];
            $(".circlechartTS").attr("data-percentage", Math.round(tsPercentage));
            $(".circlechartTS").text(tsScore + " / " + quizScore);

            $('.circlechartTS').circlechart();
            $("#tsText").text(topScorer + " (Student ID: " + studentID + ") is the top scorer for this quiz, attaining " + tsScore + " out of " + quizScore + " marks.");



            //amount of students who took the quiz



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
        url: "http://localhost/Histologie/AdministratorPHPFiles/getQuestionsByQuizId.php",
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
                        + "<td><button class='btnEdit btn btn-primary mb-2' value='" + response[i].quiz_id + "'><i class='bx bx-pencil'></i>Edit</button>&nbsp;&nbsp;"
                        + "<button class='btnDelete btn btn-danger' value='" + response[i].quiz_id + "'><i class='bx bx-trash-alt'></i>Delete</button></td>"
                        + "</tr>";
            }

            $("#questionsTable tbody").html(message);
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}//end of reload_table


