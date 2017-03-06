(function($) {
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 135 && scroll <= 1645 ) {
        $(".front-head").addClass("front-fixed");
    } else {
        $(".front-head").removeClass("front-fixed");
    }
});
})(jQuery);