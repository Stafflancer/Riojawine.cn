/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * Custom sliders
 ***********************************************/
(function ($) {
    'use strict';

    $('.sp-custom-slick').slick();

})(jQuery);


/***********************************************
 * Testimonials Slider
 ***********************************************/
(function ($) {
    'use strict';

    $('.sp-slick-testimonials').slick({
        dots          : true,
        infinite      : true,
        speed         : 750,
        slidesToShow  : 1,
        adaptiveHeight: true,
        autoplay      : true,
        arrows        : false,
        autoplaySpeed : 6500
    });

})(jQuery);


/***********************************************
 * Related Posts Slider
 ***********************************************/
(function ($) {
    'use strict';

    $('.sp-slick-related').each(function () {
        var $this = $(this);

        // do not run slider if there is less than 2 posts
        if ($this.find('.item').length <= 2) {
            return;
        }

        // init slider
        $this.slick({
            dots          : true,
            infinite      : true,
            speed         : 750,
            slidesToShow  : 2,
            slidesToScroll: 2,
            adaptiveHeight: true,
            autoplay      : true,
            arrows        : false,
            autoplaySpeed : 6500,

            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow  : 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });

})(jQuery);


/***********************************************
 * Single Post Gallery
 ***********************************************/
(function ($) {
    'use strict';

    $('.sp-slick-post-gallery').slick({
        dots          : false,
        infinite      : true,
        speed         : 750,
        slidesToShow  : 1,
        adaptiveHeight: true,
        autoplay      : true,
        autoplaySpeed : 5000,
        nextArrow     : '<div class="slick-next circle"><i class="icon-angle-right"></i></div>',
        prevArrow     : '<div class="slick-prev circle"><i class="icon-angle-left"></i></div>',
    });

})(jQuery);


/***************************************************
 * Add slick-animated class when transition is over
 ***************************************************/
(function ($) {
    'use strict';

    var $sliders = $('.slick-initialized');

    $sliders.on('initialAnimate reInit afterChange', function (e, slick, currentSlide) {
        currentSlide = currentSlide || 0;
        slick = slick || $(this).slick('getSlick');

        $(slick.$slides).removeClass('slick-animated');
        $(slick.$slides[currentSlide]).addClass('slick-animated');
    });

    $sliders.trigger('initialAnimate');

})(jQuery);


/***************************************************
 * Stop sliders that is not currently in viewport
 ***************************************************/
(function ($) {
    'use strict';

    var $sliders = $('.slick-initialized');

    PZTJS.scrollRAF($.throttle(250, function () {
        $sliders.each(function () {
            var $this = $(this),
                $slick = $this.slick('getSlick');

            // don't touch sliders without autoplay
            if ($slick.options.autoplay !== true) {
                return;
            }

            // stop slider
            if (!PZTJS.isElementInViewport(this) && !$slick.paused) {
                $this.slick('pause');
            }

            // unpause slider
            if (PZTJS.isElementInViewport(this) && $slick.paused) {
                $this.slick('play');
            }
        });
    }));

})(jQuery);


/***************************************************
 * Integrate WOW.js with slick
 ***************************************************/
(function($) {
    'use strict';

    $('.slick-initialized').on('beforeChange', function(e, slick, currentSlide, nextSlide) {
        $(slick.$slides[nextSlide]).find('.wow, .re-animate').each(function () {
            var el = $(this),
                newone = el.clone(true).removeClass('animated');

            el.before(newone);
            el.remove();
        });
    });

})(jQuery);


/***************************************************
 * Recalculate slider layout after each image loaded
 ***************************************************/
(function($) {
    'use strict';

    $('.slick-initialized img').on('load', function() {
        $(this).closest('.slick-initialized').slick('setPosition');
    });

})(jQuery);