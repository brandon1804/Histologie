$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    if ($("#lessonCategoryChooser").val() > 0) {
        $.get("./get_lesson.php", {
            category_id: $("#lessonCategoryChooser").val()
        }, function (data) {
            console.log(data);
            display_customer(data)
        }, "JSON");
    }

    $("#lessonCategoryChooser").change(function () { 
        if ($("#lessonCategoryChooser").val() > 0) {
            $.get("./get_lesson.php", {
                category_id: $("#lessonCategoryChooser").val()
            }, function (data) {
                console.log(data);
                display_customer(data)
            }, "JSON");
        }
    });

    const display_customer = (lessons) => {
        let msg = "";
        for (let i = 0; i < lessons.length; i++) {
            let n = lessons[i];
            msg += `<div class="card" style="width: 100%">`
            msg += `<div class="card-header row" id="item-header-${i}"`
            msg += `<h5 class="mr-auto">`
            msg += `<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#item-body-${i}" aria-expanded="true" aria-controls="item-body-${i}"> ${n.title}</button></h5>`
            msg += `<h5 class="ml-auto"><button class="btn" type="button" style="background-color: #ffc107; color:#fff; margin: 0 10px 0 0" role="button" onclick="showEdit(${n.lesson_id})">Edit</button>`
            msg += `<button class="btn" type="button" style="background-color: #ff5662; color:#fff" role="button" onclick="showEdit(${n.lesson_id})">Delete</button></h5></div>`
            msg += `<div id="item-body-${i}" class="collapse" aria-labelledby="item-header-${i}" data-parent="#lessonrow">`
            msg += `<div class="card-body">`
            msg += `<div id="slider-${i}" class="swiper-container swiper-container w-full swiper swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">`
            msg += `<div class="swiper-wrapper" id="swiper-wrapper-${i}" aria-live="polite" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">`
            n.images.forEach(u => {
                msg += `<img class="swiper-slide" src="./css/img/lessonImage/${n.name}/${u.filename}" id="${u.image_id}"/>`
            }); 
            msg += `</div><div class="swiper-pagination"></div>`
            msg += `<div class="swiper-button-prev"></div>`
            msg += `<div class="swiper-button-next"></div></div>`
            msg += `<span><h5>Description: </h5><p>${n.summary}</p></span>`
            msg += `</div></div></div>`
        }
        $("#lessonrow").html(msg);

        const swiper = new Swiper('.swiper-container', {
            // Optional parameters
            observer: true,
            observeParents: true,
            direction: 'horizontal',
            loop: false,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }

    $(".modal-close").click(function () { 
        $("#editLessonModal").modal("hide");
    });

    $(".modal-submit").click(function () { 
        let lesson_id = $("#lesson-id").val();
        let title = $("#lesson-title").val();
        let category_id = $("#lesson-category").val();
        let description = $("#lesson-description").val();

        $.post("./AdministratorPHPFiles/editLesson.php", {
            lesson_id: lesson_id,
            category_id: category_id,
            title: title,
            summary: description
        }, function (data) {
            alert(data.output);
            window.location.reload();
        }, "JSON");
    });
});

function showEdit(id) {
    $.get("./get_lesson.php", {
        lesson_id: id
    }, function (data) {
        let modal = "";
        for (let i = 0; i < data.length; i++) {
            const n = data[i];
            modal += `<div id="slider-${i}" class="swiper-container swiper-container w-full swiper swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">`
            modal += `<div class="swiper-wrapper" id="swiper-wrapper-${i}" aria-live="polite" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">`
            n.images.forEach(u => {
                modal += `<img class="swiper-slide modal-swiper-slide" src="./css/img/lessonImage/${n.name}/${u.filename}" id="${u.image_id}"/>`
            }); 
            modal += `</div><div class="swiper-pagination"></div>`
            modal += `<div class="swiper-button-prev"></div>`
            modal += `<div class="swiper-button-next"></div></div>`
            modal += `<div class="form-group">`
            modal += `<button type="button" class="btn btn-primary">Add Image</button>`
            modal += `<button type="button" class="btn btn-danger" onclick="removeImage()">Remove Current Image</button>`
            modal += `</div>`
            modal += `<input type="hidden" id="lesson-id" value="${id}"/>`
            modal += `<div class="form-group">`
            modal += `<label for="lesson-title">Title: </label>`
            modal += `<input name="lesson-title" class="form-control" id="lesson-title" value="${n.title}"/>`
            modal += `</div>`
            modal += `<div class="form-group">`
            modal += `<label for="lesson-category">Category: </label>`
            modal += `<select name="lesson-category" class="form-control" id="lesson-category">`
            category.forEach(u => {
                if (u.lesson_category_id === n.lesson_category_id) 
                    modal += `<option value="${u.lesson_category_id}" selected>${u.name}</option>`
                else 
                    modal += `<option value="${u.lesson_category_id}">${u.name}</option>`
            });
            modal += `</select></div>`
            modal += `<div class="form-group">`
            modal += `<label for="lesson-description">Description: </label>`
            modal += `<textarea name="lesson-description" class="form-control" id="lesson-description">${n.summary}</textarea>`
            modal += `</div>`
        }
        $(".modal-body").html(modal);

        const swiper = new Swiper('.swiper-container', {
            // Optional parameters
            observer: true,
            observeParents: true,
            direction: 'horizontal',
            loop: false,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }, "JSON"
    );

    $("#editLessonModal").modal("show");
}

function removeImage() {
    if (!confirm("are u sure you want to delete current image")) {
        return;
    }

    let image_id = $(".swiper-slide.modal-swiper-slide.swiper-slide-active").attr("id");
    let lesson_id = $("#lesson-id").val();

    $.post("./AdministratorPHPFiles/removeImage.php", {
        image_id: image_id,
        lesson_id: lesson_id
    }, function (data) {
        alert(data.output);
        window.location.reload();
    }, "JSON");
}