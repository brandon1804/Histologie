$(document).ready(function () {
    $("#msg").hide();
    $("#pwResetBtn").click(function (e){
        e.preventDefault();
        var email = $('#idEmail').val();
        $.ajax({
            url: 'doResetPassword.php',
            type: 'POST',
            data: {email: email},
            success: function (response) {
                $(".card-body").html(response);
                $(".card-img-top").hide();
                $("#pwResetBtn").hide();
            }
        });
    });
});
