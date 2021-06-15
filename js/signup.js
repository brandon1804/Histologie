$(document).ready(function () {

    $("#signupBtn").click(function (e) {
        e.preventDefault();
        var email = $('#idEmail').val();
        var password = $('#idPassword').val();
        var name = $('#idName').val();
        var id = $('#id').val();
        var staffORstudent = $(':radio:checked').val();


        $.ajax({
            url: 'doSignUp.php',
            type: 'POST',
            data: {name: name, id: id, email: email, password: password, accountType: staffORstudent},
            success: function (response) {
                $(".card-body").html(response);
                $(".card-img-top").hide();
                $("#signupBtn").hide();
                $("#AA").hide();
            }
        });
    });
});
