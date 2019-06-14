/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * Countdown widget init
 ***********************************************/
(function ($) {
    'use strict';

    // setup events
    var $blocks = $('.sp-countdown-block').on('update.countdown', function (event) {
        var $this = $(this);

        $this.find('.remaining-timer.seconds > .count').html(event.strftime('%S'));
        $this.find('.remaining-timer.minutes > .count').html(event.strftime('%M'));
        $this.find('.remaining-timer.hours > .count').html(event.strftime('%H'));

        if (event.offset.days > 0) {
            $this.find('.remaining-timer.days > .count').html(event.strftime('%d'));
        } else {
            $this.find('.remaining-timer.days').hide();
        }

        if (event.offset.weeks > 0) {
            $this.find('.remaining-timer.weeks > .count').html(event.strftime('%w'));
        } else {
            $this.find('.remaining-timer.weeks').hide();
        }
    });

    // run countdowns
    $blocks.each(function () {
        var $this = $(this),
            deadline = $this.data('deadline');

        $this.countdown(deadline);
    });
})(jQuery);