/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * WOW.js appearance animation engine
 ***********************************************/
(function ($) {
    'use strict';

    var animationDuration = Modernizr.prefixed('animationDuration');

    // quit from function on mobile devices
    // ======================================
    if (PZTJS.isMobile()) {
        $('.wow.sequenced').removeClass('wow sequenced');
        $('.wow').removeClass('wow');
        return;
    }


    // sequenced animations
    // ======================================
    var seqElements = $('.wow.sequenced').each(function() {
        var $this = $(this),
            classname = $this.attr('class'),
            animDuration = $this.data('wow-duration') || '1s',
            childrenSelector = $this.data('wow-children'),
            fxname = /fx-([a-zA-Z]+)/g.exec(classname);

        // remove classnames
        $this.removeClass('wow sequenced fx-' + fxname[1]);

        // select children elements
        var $children = $this.find('> *');
        if (!childrenSelector) {
            if ($this.hasClass('wpb_column')) { // || $this.hasClass('wpb_row')
                $children = $this.find('.wpb_wrapper > *');
            }
        } else {
            $children = $this.find(childrenSelector);
        }

        // hide all non-animated children
        $children.css('visibility', 'hidden');

        // set proper animation speed
        for (var i = 0; i < $children.length; i++) {
            $children.get(i).style[animationDuration] = animDuration;
        }

        // bind animation end event
        $children.one(PZTJS.animationEnd, function() {
            $(this).removeClass('animated ' + fxname[1]);
        });

        // save data for further execution
        $this.data({
            wow_children: $children,
            wow_fx      : fxname[1]
        });
    });

    // start animations when element appears in viewport
    seqElements.one('appear', function () {
        var $this = $(this), rowStart = null;

        // get fx name
        var fxname = $this.data('wow_fx'),
            $children = $this.data('wow_children'),
            el_index = 0, row_id = 0;

        // run animation sequence
        $children.each(function () {
            var $el = $(this), currTopPosition = $el.position().top;

            // check for a new row
            if (currTopPosition !== rowStart) {
                el_index = 0;
                rowStart = currTopPosition;
                row_id++;
            }

            // run animation after some delay
            setTimeout(function() {
                $el.addClass('animated ' + fxname);
                $el.css('visibility', 'visible');
            }, (el_index * 300) + (row_id * 150));

            el_index++;
        });
    });


    // regular wow engine
    // ======================================
    var regWOW = new WOW({
        boxClass       : 'wow',      // animated element css class (default is wow)
        animateClass   : 'animated', // animation css class (default is animated)
        offset         : 0,          // distance to the element when triggering the animation (default is 0)
        mobile         : false,      // trigger animations on mobile devices (default is true)
        live           : true,       // act on asynchronously loaded content (default is true)
        scrollContainer: null,       // optional scroll container selector, otherwise use window
        callback       : function (box) {
            // the callback is fired every time an animation is started
            // the argument that is passed in is the DOM node being animated
        }
    });


    // run both engines once preloading done
    // ======================================
    $(window).one('pzt.preloader_done', function() {
        seqElements.selector = false;
        seqElements.appear({force_process: true});

        regWOW.init();
    });

})(jQuery);