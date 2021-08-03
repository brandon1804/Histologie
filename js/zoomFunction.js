$(document).ready(function () {
    $("#myRange").on("input", function () {
        $("#myRange").trigger("change");
    });

    $("#myRange").change(function () {
        let value = $("#myRange").val();
        $("#imageContainer img").css("width", `${value}%`);
    });

    $("#plus").click(function () {
        let value = Number($("#myRange").val())
        if (value >= 1000) {
            $("#imageContainer img").css("width", "3000%");
            $("#myRange").val(3000)
        } else if (value >= 200) {
            $("#imageContainer img").css("width", "1000%");
            $("#myRange").val(1000)
        } else {
            $("#imageContainer img").css("width", "200%");
            $("#myRange").val(200)
        }
    });

    $("#minus").click(function () {
        let value = Number($("#myRange").val())
        if (value > 1000) {
            $("#imageContainer img").css("width", "1000%");
            $("#myRange").val(1000);
        } else if (value > 200) {
            $("#imageContainer img").css("width", "200%");
            $("#myRange").val(200);
        } else {
            $("#imageContainer img").css("width", "100%");
            $("#myRange").val(100);
        }
    });
});