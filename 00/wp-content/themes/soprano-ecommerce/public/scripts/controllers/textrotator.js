/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * Integration with text rotator jQuery plugin
 ***********************************************/
(function ($) {
    'use strict';

    $('.sp-text-rotate').each(function () {
        var $this = $(this);

        $this.textrotator({
            animation: $this.data('animation'),
            speed    : $this.data('speed'),
            separator: '|'
        });
    });
})(jQuery);