/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * Make clicks on mobile devices smoother
 ***********************************************/
jQuery(document).ready(function () {
    'use strict';

    if(typeof FastClick === 'function') {
        FastClick.attach(document.body);
    }
});


/***********************************************
 * Disable hover effects when page is scrolled
 ***********************************************/
(function () {
    'use strict';

    var body = document.body,
        timer;

    window.addEventListener('scroll', function () {
        clearTimeout(timer);
        if (!body.classList.contains('disable-hover')) {
            body.classList.add('disable-hover');
        }

        timer = setTimeout(function () {
            body.classList.remove('disable-hover');
        }, 100);
    }, false);
})();


/***********************************************
 * Remove ugly WPCF7 autop tags
 ***********************************************/
jQuery(document).ready(function ($) {
    'use strict';

    $('.wpcf7-form').find('p').contents().unwrap();
    $('.wpcf7-form').find('br, p').remove();
});