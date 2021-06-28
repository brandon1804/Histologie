$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "getRandomLesson.php",
        cache: false,
        dataType: "JSON",
        success: function (response) {
            var message = "";
            console.log(response);

            response.forEach(i => {
                message += "<div class='col-sm-12 col-md-6 col-lg-6 col-xl-4'>"
                        + "<div class='card2 shadow;' id=" + response[i].lesson_id + ">"
                        + "<img class='img-fluid' src='css/img/lessonImage/" + response[i].filename + "' alt='lessonImage'>"
                        + "<div class='card-body'>"
                        + "<h5 class='card-title'>" + response[i].title + "</h5>"
                        + "<p class='card-text text-muted'>" + response[i].summary + "</p>" 
                        + "</div></div></div>";
            });
            $("#lessons").html(message);
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + " : " + errorThrown);
        }
    });
});

