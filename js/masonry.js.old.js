$(document).ready(function() {

    var container = document.querySelector('#ms-wrapper');
    var msnry = new Masonry( container, {
        columnWidth: 320,
        itemSelector: '.ms-item',
        isFitWidth: true
    });

});