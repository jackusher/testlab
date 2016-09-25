jQuery(window).load(function () {

var container = document.querySelector('#section1-wrap');
var msnry = new Masonry(container, {
	itemSelector: '.front-article',
	columnWidth: 1
});

var container = document.querySelector('#section2-wrap');
var msnry = new Masonry(container, {
	itemSelector: '.front-article',
	columnWidth: 1
});

});