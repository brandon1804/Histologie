$(document).ready(function () {

    updateTakeQuizPage();


}); //end of document ready


function updateTakeQuizPage() {
    var url = window.location.href;
    var stuff = url.split('=');
    var id = stuff[stuff.length - 1];

    $.ajax({
        type: "GET",
        url: "http://localhost/Histologie/QuizPHPFiles/getQuizContent.php",
        data: "id=" + id,
        cache: false,
        dataType: "JSON",
        success: function (response) {
            var message = "";
          
           
            console.log(response);
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}//end of updateQuizLandingPage

