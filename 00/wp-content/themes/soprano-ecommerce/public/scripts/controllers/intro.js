/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * Intro init
 ***********************************************/
(function ($) {
    'use strict';

    var $intro = $('.sp-intro'),
        $win = $(window);

    var initImage = function ($intro) {
        if (!$intro.attr('data-background')) { return; }
        $intro.find('> .intro-bg').length || $intro.append('<div class="intro-bg"/>');
        $intro.find('> .intro-bg').css('background-image', 'url(' + $intro.attr('data-background') + ')');
    };

    var initCarousel = function ($intro) {
        $intro.addClass('slick-dots-inside');

        $intro.on('init reInit', function () {
            $(this).find('.swipebox-video').swipebox();
        });

        var slickDefaultOptions = {
            slide        : '.slider-item',
            speed        : 1000,
            dots         : true,
            fade         : true,
            autoplay     : true,
            infinite     : true,
            autoplaySpeed: 7500
        };

        $intro.slick($.extend(slickDefaultOptions, $intro.data('slick')));
    };

    var initVideo = function($intro) {
        var $video = $intro.find('> .video-container'),
            $placeholder = $video.find('> .video-placeholder'),
            $controls = $video.find('> .video-controls');

        $video.on('YTPPlay YTPPause', function(e) {
            if(e.type === 'YTPPlay') { $controls.find('.sp-video-play > i').removeClass('icon-ion-ios-play'); }
            if(e.type === 'YTPPause') { $controls.find('.sp-video-play > i').addClass('icon-ion-ios-play'); }
        });

        $video.on('YTPMuted YTPUnmuted', function(e) {
            if(e.type === 'YTPMuted') { $controls.find('.sp-video-volume > i').removeClass('icon-ion-android-volume-up'); }
            if(e.type === 'YTPUnmuted') { $controls.find('.sp-video-volume > i').addClass('icon-ion-android-volume-up'); }
        });

        $video.YTPlayer({
            videoURL    : $video.data('url'),
            showControls: false,
            containment : 'self',
            loop        : true,
            autoPlay    : true,
            vol         : 25,
            mute        : true,
            showYTLogo  : false,
            startAt     : $video.data('start') || 0,
            stopAt      : $video.data('stop') || 0,
            onReady     : function () {
                $placeholder.fadeOut('fast');
                $controls.fadeIn('fast');
            }
        });

        $controls.find('.sp-video-play').on('click', function (e) {
            e.preventDefault();
            $video.YTPTogglePlay();
        });

        $controls.find('.sp-video-volume').on('click', function (e) {
            e.preventDefault();
            $video.YTPToggleVolume();
        });
    };

    // init all intros on the page
    $intro.each(function () {
        var $this = $(this);
        if ($this.hasClass('sp-intro-carousel')) { initCarousel($this); }
        if ($this.hasClass('sp-intro-video')) { initVideo($this); }
        if ($this.hasClass('sp-intro-image')) { initImage($this); }
    });

    // add scroll effect
    ($win.width() > 680) && PZTJS.scrollRAF(function () {
        $intro.each(function () {
            var $currIntro = $(this),
                introHeight = $currIntro.height(),
                pageYOffset = Math.max(window.pageYOffset, 0);

            if (window.pageYOffset > introHeight) {
                return;
            }

            var translateY = Math.floor(pageYOffset * 0.3) + 'px';
            // $currIntro[0].style[Modernizr.prefixed('transform')] = 'translate3d(0, ' + translateY + ', 0)';
            // $currIntro.css('opacity', (1 - pageYOffset / introHeight));
        });
    });

})(jQuery);