$(document).ready(function () {
    $("#msg").hide();
    $("#loginBtn").click(function (e){
        e.preventDefault();
        var email = $('#idEmail').val();
        var password = $('#idPassword').val();
        $.ajax({
            url: 'doLogin.php',
            type: 'POST',
            data: {email: email, password: password},
            success: function (response) {
                $(".card-body").html(response);
                $(".card-img-top").hide();
                $("#loginBtn").hide();
            }
        });
    });
});
