/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * Portfolio shuffle
 ***********************************************/
(function ($) {
    'use strict';

    // locate what we want to sort
    var $blocks = $('.sp-portfolio-block');

    // don't run this function if this page does not contain required element
    if ($blocks.length <= 0) {
        return;
    }

    // init shuffle and filters
    $blocks.each(function () {
        var $this = $(this),
            $grid = $this.find('.sp-portfolio-items'),
            $filterBtns = $this.find('.sp-portfolio-sorting a[data-group]');

        // instantiate the plugin
        $grid.pzt_shuffle({
            delimeter   : ',',
            itemSelector: '.sp-portfolio-item-wrap',
            gutterWidth : 0,
            sizer       : '.sp-portfolio-sizer',
            speed       : 600, // transition/animation speed (milliseconds).
            easing      : 'ease'
        });

        // init filters
        $filterBtns.on('click', function (e) {
            var $this = $(this);

            // hide current label, show current label in title
            $this.parent().siblings().removeClass('active');
            $this.parent().addClass('active');

            // filter elements
            $grid.shuffle('shuffle', $this.data('group'));

            e.preventDefault();
        });
    });

    // init excerpt auto-size feature
    var $portfolio_items = $blocks.find('.sp-portfolio-item');
    $(window).on('resize docready', $.debounce(250, function () {
        $portfolio_items.each(function () {
            var $this = $(this),
                $post_excerpt = $this.find('.entry-excerpt'),
                link_icon_pos = $this.find('.link-icon').offset().top,
                original_excerpt = $post_excerpt.data('pzt-original-text');

            if (!original_excerpt) {
                original_excerpt = $.trim($post_excerpt.text()).split(' ');
                $post_excerpt.data('pzt-original-text', original_excerpt);
            }

            $post_excerpt.text('');

            var accepted_words = [];
            for (var i = 0; i < original_excerpt.length; i++) {
                accepted_words.push(original_excerpt[i]);
                $post_excerpt.append(original_excerpt[i] + ' ');

                if ($post_excerpt.offset().top + $post_excerpt.outerHeight() > link_icon_pos) {
                    accepted_words.splice(-1, 1);
                    break;
                }
            }

            if (accepted_words.length < original_excerpt.length) {
                accepted_words[accepted_words.length - 1] =
                    accepted_words[accepted_words.length - 1].replace(/([ .,;!?]+)/g, '');
                $post_excerpt.text(accepted_words.join(' ') + '...');
            }
        });
    }));

})(jQuery);