$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    $("#addFAQForm").submit(function (e) { 
        e.preventDefault();

        let question = $("input[name='FAQquestion']").val();
        let answer = $("textarea[name='FAQAnswer']").val();

        $.post("./AdministratorPHPFiles/addFaq.php", {
            question: question, 
            answer: answer
        }, function (data) {
            alert(data.output);
            window.location = "manageFaqPage.php";
        }, "JSON");
    });

    $("#editFAQPage").submit(function (e) { 
        e.preventDefault();
        
        let id = $("input[name='FAQid']").val();
        let question = $("input[name='FAQquestion']").val();
        let answer = $("textarea[name='FAQAnswer']").val();

        $.post("./AdministratorPHPFiles/editFaq.php", {
            id: id,
            question: question, 
            answer: answer
        }, function (data) {
            alert(data.output);
            window.location = "manageFaqPage.php";
        }, "JSON");
    });
});

function deleteQuestion(id) {
    $.post("./AdministratorPHPFiles/deleteFaq.php", {
        id: id
    }, function (data) {
        alert(data.output);
        location.reload();
    }, "JSON");
}