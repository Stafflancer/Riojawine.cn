/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */

/**
 * jQuery FilterByData plugin
 */
(function ($) {
    'use strict';

    $.fn.filterByData = function (prop, val) {
        var $self = this;
        if (typeof val === 'undefined') {
            return $self.filter(
                function () {
                    return typeof $(this).data(prop) !== 'undefined';
                }
            );
        }
        return $self.filter(
            function () {
                return $(this).data(prop) === val;
            }
        );
    };

})(jQuery);

/**
 * Notice controller code
 */
(function ($) {
    'use strict';

    var $notice = $('.sp-notice').show(),
        $noticeBodies = $notice.find('.sp-notice-body-inner');

    // helper for sending events to google analytics
    var sendGAEvent = function (action, label) {
        // Version (v) - 1
        // Tracking ID (tid) - UA-107361219-2
        // User ID (uid) - website domain
        // Event hit type (t) - event
        // Event category (ec) - feedback-dashboard-teaser
        // Event action (ea) - dismiss/hide/accept

        var data_to_send = {
            v  : '1',
            tid: 'UA-107361219-2',
            uid: location.host,
            t  : 'event',
            ec : 'feedback-dashboard-teaser',
            ea : action
        };

        if (label) {
            data_to_send.el = label;
        }

        data_to_send.z = Math.floor(Math.random() * Math.floor(100000));

        $.post('https://www.google-analytics.com/collect', data_to_send);
    };

    // perform ajax action to change teaser state
    var performTeaserAction = function (action) {
        $.ajax({
            url   : ajaxurl,
            method: 'get',
            data  : {
                action       : 'pzt_sp_teaser',
                teaser_action: action,
                _ajax_nonce  : $notice.data('wp-nonce')
            },
            cache : false
        });
    };

    sendGAEvent('show');

    // maintain proper container size
    $(window).on('resize', function () {
        var newHeight = $noticeBodies.filter('.current').outerHeight();
        $notice.find('.sp-notice-body').css('min-height', newHeight);
    });

    // change body action
    $notice.find('a[data-action="change-body"]').on('click', function (e) {
        var $this = $(this);

        if ($this.attr('href') === '#') {
            e.preventDefault();
        }

        var newBodyId = $this.data('new-body');
        var $newBody = $noticeBodies.filterByData('body-id', newBodyId);

        sendGAEvent('change-body', newBodyId);

        $noticeBodies.removeClass('current');
        $newBody.addClass('current');

        $notice.find('.sp-notice-body').animate({
            minHeight: $newBody.outerHeight()
        }, 350);

        if (newBodyId === 'support' || newBodyId === 'thanks') {
            performTeaserAction('close');
        }
    });

    // snooze teaser action
    $notice.find('a[data-action="snooze"], a[data-action="close"]').on('click', function (e) {
        var $this = $(this);

        sendGAEvent('close', $this.text());

        if ($this.attr('href') === '#') {
            e.preventDefault();
        }

        performTeaserAction($this.data('action'));

        $notice.animate({opacity: 0}, 500, function () {
            $(this).slideUp(250);
        });
    });

    // run initial layout calculations
    $(window).trigger('resize');

})(jQuery);