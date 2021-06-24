$(document).ready(function(){
    reload_lessons();
    updateLessons();
});

function updateLessons(){
    $.ajax({
        type: "GET",
        url: "http://localhost/Histologie/getLesson.php",
        cache: false,
        dataType: "JSON",
        success: function (response){
            var message = "";
            for(i = 0; i< response.length; i++){
                message += "<div class='col-sm-12 col-md-6 col-lg-6 col-xl-4'>"
                        + "<div class='card shadow' style='width: 20rem;' id=" + response[i].lesson_id + ">"
                        + "<img class='card-img-top' src='css/img/lessonImage/" + response[i].filename + "' alt='lessonImage'>"
                        + "<div class='card-body'>"
                        + "<h5 class='card-title'>" + response[i].title + "</h5>"
                        + "<h6 class='card-subtitle text-muted'>" + response[i].summary + "<h6>"
                        + "<a href='quizResultPage.php' class='btn btn-primary'>Start lesson</a>"
                        + "</div></div></div>";
            }
            $("#lessonsRow").html(message);
        },
        error: function (obj, textStatus, erroThrown){
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}

function reload_lessons(){
    $("#idLessonCategory").change(function(){
        var lessonCat = $("#idLessonCategory").val();
        
        if(lessonCat == 0){
            updateLessons();
        }else{
            $.ajax({
                type: "GET",
                url: "http://localhost/Histologie/getLessonByCategory.php",
                data: "id=" + lessonCat,
                cache: false,
                dataType: "JSON",
                success: function (response){
                    var message = "";
                    for(i = 0; i < response.length; i++){
                        message += "<div class='col-sm-12 col-md-6 col-lg-6 col-xl-4'>"
                        + "<div class='card shadow' style='width: 20rem;' id=" + response[i].lesson_id + ">"
                        + "<img class='card-img-top' src='css/img/lessonImage/" + response[i].filename + "' alt='lessonImage'>"
                        + "<div class='card-body'>"
                        + "<h5 class='card-title'>" + response[i].title + "</h5>"
                        + "<h6 class='card-subtitle mb-2 text-muted'>" + response[i].summary
                        + "<a href='quizResultPage.php' class='btn btn-primary'>Start lesson</a>"
                        + "</div></div></div>";
                    }
                    $("#lessonsRow").html(message);
                },
                error: function (obj, textStatus, errorThrown){
                    console.log("Error " + textStatus + ": " + errorThrown);
                    $("#lessonsRow").html("");
                }
            });
        }
    });
}
