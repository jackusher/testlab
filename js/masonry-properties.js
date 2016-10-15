jQuery(window).load(function () {

var container = document.querySelector('#masonry-container');
var msnry = new Masonry(container, {
	itemSelector: '.masonry-item',
	columnWidth: 1
});

});