$(document).ready(function(){
    
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
    
    addLesson();
});

function addLesson() {
     
     var formData = new FormData();
     
     var title = "";
     var summary = "";
     var categoryYN = "";
     var lessonCategory = "";
     
     $("#lessonCategorySelectContent").hide();
     $("#lessonCategoryInputContent").hide();
     
     $("input[name='categoryYN']").change(function(){
         if(this.value === 'Yes'){
             $('#lessonCategorySelectContent').show();
             $('#lessonCategoryInputContent').hide();
         }else if (this.value === 'No'){
             $('#lessonCategorySelectContent').hide();
             $('#lessonCategoryInputContent').show();
         }
     }); 
     
     $("#addLessonForm").validate({
         rules: {
             title: {
                 required: true
             },
             summary: {
                 required: true
             },
             categoryYN: {
                 required: true
             }
         },
         messages: {
             title: {
                 required: "Please enter your title"
             },
             summary: {
                 required: "Please enter your summary"
             },
             categoryYN: {
                 required: "Please specify whether you are using an existing category"
             }
         },
         
         submitHandler: function () {
             title = $("input[name='title']").val();
             summary = $("input[name='summary']").val();
             categoryYN = $("input[name='categoryYN']:checked").val();
             
             if(categoryYN === 'Yes'){
                 lessonCategory = $("#lessonCategoryChooser option:selected").val();
                 formData.append("title", title);
                 formData.append("summary", summary);
                 formData.append("lessonCategory", lessonCategory);
                 formData.append("categoryYN", categoryYN);
                 
                 $("addLessonContent").hide();
             }
             else if (categoryYN === 'No') {
                 lessonCategory = $("input[name='lessonCategoryInput']").val();
                 $.ajax({
                     type: "GET",
                     url: "getLessonByCategory.php",
                     cache: false,
                     dataType: "JSON",
                     success: function (response) {
                         var categoryExists = false;
                         
                         for(var i= 0; i<= response.length; i++){
                             if(lessonCategory === response[i]) {
                                 categoryExists = true;
                             }
                         }
                         
                         if(categoryExists === false){
                             lessonCategory = $("#lessonCategoryChooser option:selected").val();
                             formData.append("title", title);
                             formData.append("summary", summary);
                             formData.append("lessonCategory", lessonCategory);
                             formData.append("categoryYN", categoryYN);
                             
                             $("addLessonContent").hide();
                         }
                         else if (categoryExists === true){
                             $('#category_exists_modal').modal('show');
                         }
                     }
                 });
             }
             
             return false;
         }
     });
     
     $.ajax({
         url: 'AdministratorPHPFiles/addLesson.php',
         enctype: 'multipart/form-data',
         type: 'POST',
         data: formData,
         contentType: false,
         processData: false,
         success: function (response) {
                    var buttonAdd = "<a class='btn d-flex align-items-center' href='addQuizQuestionPage.php?quiz_id=" + response + "' role='button' style='background-color: #00D207; color:#fff'><i class='bx bx-sm bx-plus'></i>Add Another Question</a>";
                    $('#publish_quiz_modal .modal-footer').append(buttonAdd);
                    $('#publish_quiz_modal').modal('show');
                },
                error: function (obj, textStatus, errorThrown) {
                    console.log("Error " + textStatus + ": " + errorThrown);
                }
            });
            
            return false;
        };
