$('.sub-menu').hide();

$("li:has(ul)").click(function(){

$("ul",this).slideDown();

});