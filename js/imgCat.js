$(document).ready(function () {
    updateImages();
});

function updateImages() {
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
                        + "<img class='card-img-top' src='css/img/homepageImg/" + response[i].images[0].filename + "' alt='homepageImg'>"
                        + "<div class='card-body'>"
                        + "<h5 class='card-title'>" + response[i].name + "</h5>"
                        + "<a href='specimens.php?category_id="+response[i].image_category_id+"' class='btn btn-primary'>More Info</a>"
                        + "</div></div></div>";
            }
            $("#imgRow").html(message);
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}