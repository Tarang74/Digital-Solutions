var header = document.querySelector('.header');
var overlay = document.querySelector('.overlay');
var logoContainer = document.querySelector('.logoContainer');

(function ( w ) {
    w.addEventListener('scroll', function() {
        if (w.pageYOffset < 70) {
            header.classList = 'header';
            overlay.classList = 'overlay';
            logoContainer.classList = 'logoContainer';
        } else {
            header.classList = 'header header_shrink';
            overlay.classList = 'overlay overlay_hidden';
            logoContainer.classList = 'logoContainer logoContainer_shrink';
        }
    })
})( window );