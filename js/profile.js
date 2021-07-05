$(document).ready(function () {

    $("#defaultForm").validate({
        rules: {
            name: {
                required: true,
                pattern: /^[a-zA-Z]* $/
            },
            email: {
                required: true,
                pattern: /^(\w+[\-\.])*\w+@(\w+\.)+[A-Za-z]+$/
            },
            password: {
                required: true,
                pattern: /^[A-Za-z\d]{6,8}$/
            }
        },
        messages: {
            name: {
                required: "Please enter new name",
                pattern: "Name must contain only alphabet"
            },
            email: {
                required: "Please enter new email",
                pattern: "Please enter a valid email"
            },
            password: {
                required: "Please enter new password",
                pattern: "Password must be 6 to 8 character long"
            }
        },

        submitHandler: function () {
            var name = $("#idName").val();
            var email = $("#idEmail]").val();
            var password = $("idPassword").val();
            $.ajax({
                url: "doProfile.php",
                type: "POST",
                data: "name=" + name + "&email=" + email + "&password=" + password,
                success: function (data) {
                     alert("Success");
                },
                error: function (obj, textStatus, errorThrown) {
                    $("#editprofileMsg").html("Unable to update record");
                    console.log("Error" + textStatus + ":" + errorThrown);
                    return false;
                }
            });
            return true;
        }
    });

});//end of document ready
