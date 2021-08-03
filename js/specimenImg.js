$(document).ready(function () {
    
    $("form").click(function(e){
        let id = e.currentTarget.id;
        console.log(e);
        $("#" + id).submit();
        
    })
});