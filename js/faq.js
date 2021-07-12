$(document).ready(function(){
$(".sec").eq(0).click(function(){
$(this).next(".collapsable").slideToggle();
$(this).children(".section").text("What is Histologie?");
$(this).children(".fa").toggleClass("fa-minus");

});
$(".sec").eq(1).click(function(){
$(this).next(".collapsable").slideToggle();
$(this).children(".section").text("What is Histologie?");
$(this).children(".fa").toggleClass("fa-minus");
});
$(".sec").eq(2).click(function(){
$(this).next(".collapsable").slideToggle();
$(this).children(".section").text("What is Histologie?");
$(this).children(".fa").toggleClass("fa-minus");
});
$(".sec").eq(3).click(function(){
$(this).next(".collapsable").slideToggle();
$(this).children(".section").text("What is Histologie?");
$(this).children(".fa").toggleClass("fa-minus");
});

});


