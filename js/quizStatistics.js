$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    updateQuizStatistics();



}); //end of document ready


function updateQuizStatistics() {
    var url = window.location.href;
    var stuff = url.split('=');
    var quiz_id = stuff[stuff.length - 1];



    $.ajax({
        type: "GET",
        url: "AdministratorPHPFiles/getManageQuizDetails.php",
        data: "quiz_id=" + quiz_id,
        cache: false,
        dataType: "JSON",
        success: function (response) {
            var students = response['students'];
            var completed = response['quizzesCompleted'];

            $("#quizTitle").html(response['title'] + " Quiz Statistics");

            var completedPercentage = (completed / students) * 100;
            $(".circlechartSC").attr("data-percentage", Math.round(completedPercentage));
            $(".circlechartSC").text(completed + " / " + students);

            $('.circlechartSC').circlechart();
            $("#scText").text(completed + " out of " + students + " students have completed this quiz.");

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


            var message = "";
            var rankings = response['rankings'];
            for (var i = 0; i < rankings.length; i++) {
                if (rankings[i].user_score === tsScore) {
                    message += "<tr><td>" + (i + 1) + "</td>"
                            + "<td>" + rankings[i].name + " (Student ID: " + rankings[i].student_id + ")</td>"
                            + "<td>" + rankings[i].user_score + "</td>"
                            + "<td>" + rankings[i].quiz_taken_date + "</td>"
                            + "</tr>";
                }//end of top scorer
                else {
                     message += "<tr><td>" + (i + 1) + "</td>"
                            + "<td>" + rankings[i].name + " (Student ID: " + rankings[i].student_id + ")</td>"
                            + "<td>" + rankings[i].user_score + "</td>"
                            + "<td>" + rankings[i].quiz_taken_date + "</td>"
                            + "</tr>";
                }

            }

            $("#rankingTable tbody").html(message);



        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}//end of updateQuizStatistics





