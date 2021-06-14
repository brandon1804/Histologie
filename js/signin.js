$(document).ready(function () {
    $("#msg").hide();
    $("#loginBtn").click(function (e){
        e.preventDefault();
        var username = $('#idEmail').val();
        var password = $('#idPassword').val();
        $.ajax({
            url: 'doLogin.php',
            type: 'POST',
            data: {username: username, password: password},
            success: function (response) {
                var msg = "";
                $("#msg").html(response);
            }
        })
    });
})
