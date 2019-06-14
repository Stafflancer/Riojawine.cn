/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * Sticky sidebar feature
 ***********************************************/
(function ($) {
    'use strict';

    $('.sp-sidebar.sticky').stick_in_parent({
        offset_top: $('#sp-header').outerHeight() + 30
    });

})(jQuery);