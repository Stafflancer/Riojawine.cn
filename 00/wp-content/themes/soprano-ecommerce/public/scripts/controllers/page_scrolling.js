/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * Scroll to anchor
 ***********************************************/
(function($) {
    'use strict';

    // Select all links with hashes
    $('a[href*="#"]')
        // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .on('click', function(event) {
            // On-page links
            if (
                $(this).closest('[data-sp-nojump]').length === 0
                &&
                location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '')
                &&
                location.hostname === this.hostname
            ) {
                // Figure out element to scroll to
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?
                if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - 55
                    }, 1500, 'easeInOutExpo', function() {
                        // Callback after animation
                        // Must change focus!
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        }
                    });
                }
            }
        });

})(jQuery);


/***********************************************
 * Scroll to Top button
 ***********************************************/
(function($) {
    'use strict';

    var offset = 500,
        $back_to_top = $('.sp-scroll-top');

    PZTJS.scrollRAF(function() {
        if (window.pageYOffset > offset) {
            $back_to_top.addClass('scroll-top-visible');
        } else {
            $back_to_top.removeClass('scroll-top-visible');
        }
    });

    $back_to_top.on('mouseover mouseout', function() {
        $(this).find('.anno-text').stop().animate({
            width: 'toggle',
            padding: 'toggle'
            // display: 'inline'
        });
    });

})(jQuery);