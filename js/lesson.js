$(document).ready(function () {
    
    $('.navbar-toggler').click(function () {
        $('#navbarSupportedContent').toggleClass('collapse');
    });
    
    var url = window.location.href;
    var stuff = url.split('=');
    var id = stuff[stuff.length - 1];

    $.get("./get_lesson.php", {
    }, function (data) {
        if (id > data.length) {
            window.location.replace("lessonpage.php?lesson_id=" + (data.length));
        } else if (id === data.length) {
            $('#nextLesson').attr('disabled', true);
        }
    }, "JSON"
            );

    $('#nextLesson').on('click', function () {
        var newID = parseInt(id) + 1;
        window.location.href = "lessonpage.php?lesson_id=" + newID;
    });
    $('#prevLesson').on('click', function () {
        var newID = parseInt(id) - 1;
        if (newID = 1) {
            $('#prevLesson').attr('disabled', true);
        } else {
            $('#prevLesson').attr('disabled', false);
        }
        window.location.href = "lessonpage.php?lesson_id=" + newID;
    });

    $.get("./getLessonMaterial.php", {
        id: `${id}`
    }, (data) => {
        var message = "";
        $("#title").html(data.title);
        for (let i = 0; i < data.slides.length; i++) {
            message += "<div class='swiper-slide' role='group'>"
                    + "<div class='swiper-zoom-container' style='transition-duration: 300ms; transform: translate3d(0px, 0px, 0px);'>"
                    + "<img src='./css/img/lessonImage/" + data.title + "/" + data.slides[i] + "' style='transition-duration: 300ms; transform: translate3d(0px, 0px, 0px) scale(1);'>"
                    + "</div></div>";
        }
        ;
        $("#swiper-wrapper-10fc5411034466b78e").html(message);
    }, "JSON");

    var swiper = new Swiper('.swiper-container', {
        direction: 'horizontal',
        zoom: true,
        loop: false,

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        observer: true,
        observeParents: true,
    });
});
