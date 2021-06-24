$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    updateCards();

}); //end of document ready

function updateCards() {
    $.ajax({
        type: "GET",
        url: "http://localhost/Histologie/AdministratorPHPFiles/getDashboardContent.php",
        cache: false,
        dataType: "JSON",
        success: function (response) {
            $("#amountOfImages").text(response['images']);
            $("#lessonsCompleted").text(response['lessons']);
            $("#quizzesCompleted").text(response['quizzes']);
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}//end of updateCards