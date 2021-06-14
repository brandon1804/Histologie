$(document).ready(function () {

    updateQuizPage();

 
}); //end of document ready


function updateQuizPage() {
    var url = window.location.href;
    var stuff = url.split('=');
    var id = stuff[stuff.length - 1];
    console.log(id);
    
    $.ajax({
        type: "GET",
        url: "getQuizContent.php",
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
}//end of updateQuizzes


