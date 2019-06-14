/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * Typed.js integration
 ***********************************************/
jQuery(window).one('pzt.preloader_done', function () {
    'use strict';

    var $ = jQuery;

    // process each typed-enabled element
    $('[data-typed-str]').each(function () {
        var $this = $(this),
            texts = $this.attr('data-typed-str').split('|');

        $this.html('').append('<span class="typed-container"></span>');
        $this.find('> .typed-container').typed({
            strings   : texts,
            typeSpeed : 65,
            loop      : ($this.attr('data-typed-repeat') === 'yes'),
            backDelay : 1500,
            showCursor: ($this.attr('data-typed-cursor') === 'yes')
        });
    });
});