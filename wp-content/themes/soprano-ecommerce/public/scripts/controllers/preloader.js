/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * Preloader
 ***********************************************/
(function ($) {
    'use strict';

    var $window = $(window);

    $window.on('load', function () {
        $window.trigger('pzt.preloader_done');

        setTimeout(function () {
            $('body').addClass('sp-page-loaded');
            $('#sp-preloader').fadeOut('slow');
        }, 250);
    });
})(jQuery);