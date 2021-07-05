$(document).ready(function () {
    $("#msg").hide();
    $("#pwResetBtn").click(function (e){
        var email = $('#idEmail').val();
        $.ajax({
            url: 'gmail/testmail.php',
            type: 'POST',
            data: {email: email},
            success: function (response) {
                console.log(response);
                $(".card-body").html(response);
                $(".card-img-top").hide();
                $("#pwResetBtn").hide();
            }
        });
    });
});

/*
  $("#defaultForm").validate({
                    rules: {
                        email: {
                            required: true,
                            pattern: /^(\w+[\-\.])*\w+@(\w+\.)+[A-Za-z]+$/
                        }
                    },
                    messages: {
                        email: {
                            required: "Please enter new email",
                            pattern: "Please enter a valid email"
                        }
                    },

                    submitHandler: function () {
                        return true;
                    }
                });
            });
 */