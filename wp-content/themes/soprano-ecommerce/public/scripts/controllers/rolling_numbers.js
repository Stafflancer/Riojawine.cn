/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * Count up numbers
 ***********************************************/
(function ($) {
    'use strict';

    var $elems = $('.sp-animate-numbers h1');

    // run when appear
    $elems.one('appear', function () {
        numberRoller(this);
    });

    $(window).one('pzt.preloader_done', function() {
        $elems.appear({force_process: true});
    });

    function numberRoller(roller_elem) {
        var $roller = $(roller_elem);
        var min = $roller.attr('data-min');
        var max = $roller.attr('data-max');
        var timediff = $roller.attr('data-delay');
        var increment = $roller.attr('data-increment');
        var numdiff = max - min;
        var timeout = (timediff * 1000) / numdiff;
        numberRoll(roller_elem, min, max, increment, timeout);
    }

    function numberRoll(roller_elem, min, max, increment, timeout) {
        var $roller = $(roller_elem);

        if (min <= max) {
            $roller.html(min);
            min = parseInt(min, 10) + parseInt(increment, 10);
            setTimeout(function () {
                numberRoll(roller_elem, parseInt(min), parseInt(max), parseInt(increment), parseInt(timeout));
            }, timeout);
        } else {
            $roller.html(max);
        }
    }

})(jQuery);