jQuery(window).load(function () {

var container = document.querySelector('#section1-content');
var msnry = new Masonry(container, {
	itemSelector: '.front-article',
	columnWidth: 1
});

var container = document.querySelector('#section2-content');
var msnry = new Masonry(container, {
	itemSelector: '.front-article',
	columnWidth: 1
});

var container = document.querySelector('#section3-content');
var msnry = new Masonry(container, {
	itemSelector: '.front-article',
	columnWidth: 1
});

var container = document.querySelector('#archive-content');
var msnry = new Masonry(container, {
	itemSelector: '.front-article',
	columnWidth: 1
});

});