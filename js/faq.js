$(document).ready(function () {
    console.log("ready")
    $.get("get_all_faqs.php", {},
        function (data) {
            console.log(data)
            let msg = ""
            data.forEach(i => {
                msg += `<div class="faq-container">`
                msg += `<div class="title-container">`
                msg += `<h5><b>${i.faq_title}</b></h5>`
                msg += `</div><p class="answer-container">`
                msg += i.faq_answer
                msg += `</p></div>`
            });
            $(".list-of-faq").html(msg);
        }, "JSON"
    );
});