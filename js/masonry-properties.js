jQuery(window).load(function() {

var container = document.querySelector('.masonry-wrapper');
var msnry = new Masonry( container, {
	itemSelector: '.masonry-block',
	columnWidth: 1,
});

});