/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */

/***********************************************
 * Animated Circles
 ***********************************************/
(function ($) {
    'use strict';

    var el = $('.sp-circle'),
        delay = 0,
        options = {
            value     : 0,
            size      : 125,
            thickness : 2,
            fill      : {color: "#111"},
            emptyFill : "#ddd",
            startAngle: 300,
            animation : {duration: 2500, easing: 'easeInOutQuint'}
        };

    el.one('appear', function () {
        var $el = $(this);
        setTimeout(function () {
            $el.circleProgress('value', $el.data('value'));
        }, delay);
        delay += 150;
    });

    el.circleProgress(options).on('circle-animation-progress', function (event, progress, stepValue) {
        $(this).find('span').text((stepValue * 100).toFixed(1));
    });

    setInterval(function () { delay = 0; }, 1000);

    $(window).one('pzt.preloader_done', function() {
        el.appear({force_process: true});
    });

})(jQuery);