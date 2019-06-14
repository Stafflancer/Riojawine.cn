/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * Progress Bar
 ***********************************************/
(function ($) {
    'use strict';

    var $el = $('.sp-progress-bar'),
        delay = 0;

    $el.each(function() {
        var $this = $(this),
            $pv = $this.find('.progress-value'),
            $pb = $this.find('.progress-bar');

        $pv.html('0%');
        $pb.css('width', 0);
    });

    $el.one('appear', function () {
        var $this = $(this),
            $pv = $this.find('.progress-value'),
            $pb = $this.find('.progress-bar');

        setTimeout(function () {
            $pb.animate({
                width: $this.data('value')
            }, {
                duration: 2500,
                easing  : 'easeInOutQuint',
                step    : function (now, fx) {
                    $pv.html(now.toFixed(0) + fx.unit);
                }
            });
        }, delay);
        delay += 300;
    });

    setInterval(function () { delay = 0; }, 1000);

    $(window).one('pzt.preloader_done', function () {
        $el.appear({force_process: true});
    });

})(jQuery);