/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */

/***********************************************
 * Footer scrolling animation
 ***********************************************/
(function($) {
    'use strict';

    var $window = $(window),
        $footer = $('#sp-footer'),
        $sizing_helper = $('#sp-footer-sizing-helper');

    if (!$footer.hasClass('sp-footer-fixed')) {
        return;
    }

    // footer sizing helper height calculation
    var last_footer_height = -1;
    setInterval(function () {
        if (last_footer_height === $footer.outerHeight()) {
            return;
        }

        last_footer_height = $footer.outerHeight();
        $sizing_helper.css('height', $footer.outerHeight());

        if ($footer.outerHeight() >= ($window.outerHeight() / 1.5)) {
            $footer.css('position', 'static');
            $footer.find('> div').css('opacity', 1);
            $sizing_helper.hide();
        } else {
            $footer.css('position', 'fixed');
            $sizing_helper.show();
        }
    }, 750);

    // scrolling animation
    PZTJS.scrollRAF(function () {
        var helper_offset = $sizing_helper.offset().top,
            wScrollBottom = $window.scrollTop() + $window.outerHeight();

        if (wScrollBottom <= helper_offset || $footer.css('position') === 'static') {
            return;
        }

        $footer.find('> div').css('opacity', (wScrollBottom - helper_offset) / $footer.outerHeight());
    });

})(jQuery);