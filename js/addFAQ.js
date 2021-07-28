/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    
    addQuestion();
});

function addQuestion(){
    
    var formData = new FormData();
    
    var question = "";
    var answer = "";
    
    $("#addFAQForm").validate({
        rules: {
            question: {
                required: true
            },
            answer: {
                required: true
            }
        },
        messages: {
            question: {
                required: "Please enter the question"
            },
            answer: {
                required: "Please enter the question answer"
            }
        },
        submitHandler: function () {
            question = $("textarea[name='question']").val();
            answer = $("textarea[name='question']").val();
            $.ajax({
                url: "addFAQ.php",
                type: "POST",
                data: formData,
                proessData: false,
                contentType: false,
                success: function (response){
                }
            })
        }
    });
}


