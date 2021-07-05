$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    updateCards();
    reload_table();



    $("#defaultTable").on("click", ".btnEdit", function () {
        var id = $(this).val();
        $.ajax({
            type: "GET",
            url: "AdministratorPHPFiles/getStudentDetails.php",
            cache: false,
            data: "student_id=" + id,
            dataType: "JSON",
            success: function (data) {
                $("[name=studentidE]").val(data.student_id);
                $("[name=nameE]").val(data.name);
                $("[name=emailE]").val(data.email);
                $("[name=atE]").val(data.account_type);
                $("#edit_modal").modal('show');
            },
            error: function (obj, textStatus, errorThrown) {
                console.log("Error " + textStatus + ": " + errorThrown);
            }
        });
    });



    var edit_validator = $("#edit_form").validate({
        rules: {
            firstname: {
                required: true
            },
            lastname: {
                required: true
            }
        },
        messages: {
            firstname: {
                required: "Please enter the student's first name"
            },
            lastname: {
                required: "Please enter the student's last name"
            }
        },
        submitHandler: function () {

            var studentid = $("[name=studentidE]").val();
            var name = $("[name=nameE]").val();
            var email = $("[name=emailE]").val();
            var account_type = $("[name=atE]").val();

            $.ajax({
                type: "POST",
                url: "AdministratorPHPFiles/editStudent.php",
                cache: false,
                data: "studentid=" + studentid + "&name=" + name + "&email=" + email + "&account_type=" + account_type,
                dataType: "JSON",
                success: function (data) {
                    $("#edit_modal").modal('hide');
                    reload_table();
                },
                error: function (obj, textStatus, errorThrown) {
                    $("#addErrorMsgE").html("Unable to edit record");
                    console.log("Error " + textStatus + ": " + errorThrown);
                    return false;
                }
            });
        }//end of submitHandler
    });

    $("#edit_modal").on('hidden.bs.modal', function () {
        $("#edit_form")[0].reset();
        edit_validator.destroy();
    });



    $("#defaultTable").on("click", ".btnDelete", function () {
        var id = $(this).val();
        var result = confirm("Delete Student?");
        if (result === true) {
            $.ajax({
                type: "GET",
                url: "AdministratorPHPFiles/deleteStudent.php",
                cache: false,
                data: "studentid=" + id,
                dataType: "JSON",
                success: function (data) {
                    reload_table();
                },
                error: function (obj, textStatus, errorThrown) {
                    console.log("Error " + textStatus + ": " + errorThrown);
                }
            });
        }//end of result true
        else {
            return false;
        }
    });



}); //end of document ready

function reload_table() {

    $.ajax({
        type: "GET",
        url: "AdministratorPHPFiles/getStudents.php",
        cache: false,
        dataType: "JSON",
        success: function (response) {
            var message = "";
            var students = [];
            for (i = 0; i < response.length; i++) {
                message += "<tr><td>" + response[i].name + "</td>"
                        + "<td>" + response[i].student_id + "</td>"
                        + "<td>" + response[i].email + "</td>"
                        + "<td>" + response[i].account_type + "</td>"
                        + "<td><button class='btnEdit btn btn-primary' value='" + response[i].student_id + "'><i class='bx bx-pencil mr-1'></i>Edit</button>&nbsp;&nbsp;"
                        + "<button class='btnDelete btn btn-danger' value='" + response[i].student_id + "'><i class='bx bx-trash-alt mr-1'></i>Delete</button></td>"
                        + "</tr>";
            }

            $("#defaultTable tbody").html(message);
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}//end of function

function updateCards() {
    $.ajax({
        type: "GET",
        url: "AdministratorPHPFiles/getStudentContent.php",
        cache: false,
        dataType: "JSON",
        success: function (response) {
            $("#amountofStudents").text(response['students']);
            $("#lessonsCompleted").text(response['lessons']);
            $("#quizzesCompleted").text(response['quizzes']);
        },
        error: function (obj, textStatus, errorThrown) {
            console.log("Error " + textStatus + ": " + errorThrown);
        }
    });
}//end of updateCards