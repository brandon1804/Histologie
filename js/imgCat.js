$(document).ready(function () {
    reload_lessons();
    updateLessons();
});

function updateLessons() {
    $.ajax({
        type: "GET",
        url: "getImgCat.php",
        cache: false,
        dataType: "JSON",
        success: function (response) {
            var message = "";
            var output = "";

            for (i = 0; i < response.length; i++) {
                message += "<div class='col-sm-12 col-md-6 col-lg-6 col-xl-4'>"
                        + "<div class='card shadow' style='width: 20rem;' id=" + response[i].image_category_id + ">"
                        + "<img class='card-img-top' src='css/img/homepageImg/" + response[i].filename + "' alt='homepageImg'>"
                        + "<div class='card-body'>"
                        + "<h5 class='card-title'>" + response[i].name + "</h5>"
                        + "<a href='specimens.php' class='btn btn-primary'>More Info</a>"
                        + "</div></div></div>";
            }
            $("#imgRow").html(message);
        },
        error: function (obj, textStatus, erroThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}

function reload_lessons() {
    $("#idImgCategory").change(function () {
        var imgCat = $("#idImgCategory").val();

        if (imgCat == 0) {
            updateLessons();
        } else {
            $.ajax({
                type: "GET",
                url: "getImgByCategory.php",
                data: "id=" + imageCat,
                cache: false,
                dataType: "JSON",
                success: function (response) {
                    var message = "";
                    for (i = 0; i < response.length; i++) {
                        message += "<div class='col-sm-12 col-md-6 col-lg-6 col-xl-4'>"
                                + "<div class='card shadow' style='width: 20rem;' id=" + response[i].image_id + ">"
                                + "<img class='card-img-top' src='css/img/homepageImg/" + response[i].filename + "' alt='homepageImg'>"
                                + "<div class='card-body'>"
                                + "<h5 class='card-title'>" + response[i].name + "</h5>"
                                + "<a href='specimen.php' class='btn btn-primary'>More Info</a>"
                                + "</div></div></div>";
                    }
                    $("#imgRow").html(message);
                },
                error: function (obj, textStatus, errorThrown) {
                    console.log("Error " + textStatus + ": " + errorThrown);
                    $("#imgRow").html("");
                }
            });
        }
    });
}

