$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "getRandomImages.php",
        cache: false,
        dataType: "JSON",
        success: function (response) {
            var message = "";
            console.log(response);

            response.forEach(i => {
                message += "<div class='col-md-6 col-lg-3'>"
                        + `<a class='lightbox' href='./css/img/homepageImg/${i.filename}'>`
                        + `<img src='./css/img/homepageImg/${i.filename}' class='image' alt='image'>`
                        + `<div class='overlay'>`
                        + `<div class='text'>${i.name}</div>`
                        + "</div></a></div>";
            });
            $("#images").html(message);
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + " : " + errorThrown);
        }
    });
});