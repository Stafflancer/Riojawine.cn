/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * Masonry Clients Layout
 ***********************************************/
(function ($) {
    'use strict';

    var $grid = $('.sp-clients-grid'); // locate what we want to sort

    // don't run this function if this page does not contain required element
    if ($grid.length <= 0) {
        return;
    }

    // instantiate the plugin
    $grid.pzt_shuffle({
        itemSelector: '[class*="col-"]',
        gutterWidth : 0,
        speed       : 600, // transition/animation speed (milliseconds).
        easing      : 'ease'
    });
})(jQuery);


/***********************************************
 * Masonry Blog Layout
 ***********************************************/
(function ($) {
    'use strict';

    var $grid = $('#sp-blog-grid'); // locate what we want to sort

    // don't run this function if this page does not contain required element
    if ($grid.length <= 0) {
        return;
    }

    // instantiate the plugin
    $grid.pzt_shuffle({
        itemSelector: '[class*="col-"]',
        gutterWidth : 0,
        speed       : 600, // transition/animation speed (milliseconds).
        easing      : 'ease'
    });
})(jQuery);


/***********************************************
 * WooCommerce shuffle grid
 ***********************************************/
(function ($) {
    'use strict';

    var $grid = $('.sp-woo-grid'); // locate what we want to sort

    // don't run this function if this page does not contain required element
    if ($grid.length <= 0) {
        return;
    }

    // instantiate the plugin
    $grid.pzt_shuffle({
        itemSelector: '[class*="col-"]',
        gutterWidth : 0,
        speed       : 600, // transition/animation speed (milliseconds).
        easing      : 'ease'
    });
})(jQuery);


/***********************************************
 * Attach shuffle to standard WP galleries
 ***********************************************/
(function($) {
    'use strict';

    $('.entry-content, .entry-excerpt').find('.gallery').each(function () {
        var $this = $(this);
        $this.addClass('shuffle-gallery');

        // plugin init
        $this.pzt_shuffle({
            itemSelector: '.gallery-item',
            speed       : 500
        });

        // update layout each time image loaded
        if (typeof jQuery.fn.imagesLoaded !== 'undefined') {
            $this.imagesLoaded().progress(function () {
                shuffle.layout();
            });
        }
    });
})(jQuery);


/***********************************************
 * Latest news grid
 ***********************************************/
(function ($) {
    'use strict';

    var $grid = $('.sp-latest-news-widget'); // locate what we want to sort

    // don't run this function if this page does not contain required element
    if ($grid.length <= 0) {
        return;
    }

    // instantiate the plugin
    $grid.pzt_shuffle({
        itemSelector: '.post-item-wrapper',
        gutterWidth : 0,
        speed       : 600, // transition/animation speed (milliseconds).
        easing      : 'ease'
    });
})(jQuery);