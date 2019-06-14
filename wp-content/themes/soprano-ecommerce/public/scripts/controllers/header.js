/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * Proper animation delays for mobile menu
 ***********************************************/
(function($) {
    'use strict';

    var $html = $('html'),
        $burger_menu = $('#sp-mobile-nav-container'),
        $burger_trigger = $('#sp-mobile-nav-trigger'),
        animDelay = Modernizr.prefixed('animationDelay');

    $burger_menu.find('.nav_menu > li').each(function() {
        var $this = $(this);
        $this[0].style[animDelay] = 300 + ($this.index() * 150) + 'ms';
    });

    // submenu open trigger
    $burger_menu.find('.menu-item-has-children > a').on('click', function (e) {
        var $this = $(this),
            $current_menu_item = $(this).parent();

        $burger_menu.find('.menu-item-has-children').each(function () {
            if (!$.contains(this, $current_menu_item.get(0))) {
                $(this).find('> a').removeClass('sub-active').next('ul').slideUp(250);
            }
        });

        if ($this.next('ul').is(':visible') === false) {
            $this.addClass('sub-active').next('ul').slideDown(250);
        }

        e.preventDefault();
    });

    // toggle state of the burger menu
    var burger_menu_open = false;
    $burger_trigger.on('click', function (e) {
        e.preventDefault();

        burger_menu_open = !burger_menu_open;
        $html.toggleClass('sp-active-burger-menu', burger_menu_open);

        var header_height = $('#sp-header').outerHeight();
        $burger_menu.css('border-top-width', header_height);

        $burger_menu.find('.sub-active').each(function () {
            $(this).removeClass('sub-active').next('ul').hide();
        });
    });

    // close fullscreen menu on menu item click
    $burger_menu.find('.nav_menu a').on('click', function () {
        if ($(this).parent().hasClass('menu-item-has-children') === false) {
            burger_menu_open && $burger_trigger.trigger('click');
        }
    });

    // fix scrolling issues on mobile when menu is open
    $(document).on('touchmove', function (e) {
        if (burger_menu_open && !$(e.target).closest($burger_menu).length) {
            e.preventDefault();
        }
    });

})(jQuery);


/***********************************************
 * Desktop menu
 ***********************************************/
(function($) {
    'use strict';

    var $win = $(window),
        $header = $('#sp-header');

    // dropdown autoposition
    $win.on('docready load resize', $.debounce(250, function () {
        $header.find('.sub-menu').each(function () {
            var $this = $(this);
            if ($this.offset().left + $this.outerWidth() >= ($win.outerWidth() - 25)) {
                $this.addClass('invert-attach-point');
            }
        });
    }));

    // sticky menu (150 is a scroll offset in pixels)
    PZTJS.scrollRAF(function () {
        if (window.pageYOffset > 150 && !$header.hasClass('header-stuck')) {
            $header.addClass('header-stuck');
        }

        if (window.pageYOffset <= 150 && $header.hasClass('header-stuck') && !$header.hasClass('without-image')) {
            $header.removeClass('header-stuck');
        }
    });

    // disable jumps for empty-anchor links
    $header.find('.nav_menu a[href="#"]').on('click', function (e) {
        e.preventDefault();
    });

})(jQuery);


/***********************************************
 * Fullscreen search
 ***********************************************/
(function($) {
    'use strict';

    var $toggle = $('#sp-header').find('.sp-search-icon'),
        $searchContainer = $('#sp-search-block-container');

    // focus input when container is visible
    $searchContainer.find('> .search-block-inner').on(PZTJS.transitionEnd, function() {
        $(this).is(':visible') && $(this).find('.search-input').focus();
    });

    // close on click
    $searchContainer.find('.close-search').on('click', function(event) {
        event.preventDefault();
        $searchContainer.removeClass('open');
    });

    // close on esc keyup
    $(document).keyup(function(e) {
        (e.keyCode === 27) && $searchContainer.removeClass('open');
    });

    // open trigger
    $toggle.on('click', function(event) {
        event.preventDefault();
        $searchContainer.addClass('open');
    });

})(jQuery);