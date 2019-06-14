/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */

/***********************************************
 * FAQ card toggles
 ***********************************************/
(function ($) {
    'use strict';

    // set initial states
    var $cards = $('.sp-faq-list .sp-faq-card').each(function() {
        var $this = $(this);
        $this.find('> .card-contents').toggleClass('show', $this.hasClass('card-open'));
    });

    $cards.find('> .card-contents').on('show.bs.collapse hide.bs.collapse', function (e) {
        var $card = $(this).closest('.sp-faq-card');
        $card.toggleClass('card-open', (e.type === 'show'));
    });

    // attach event listener
    $cards.find('> .card-header').on('click', function() {
        var $card = $(this).closest('.sp-faq-card'),
            $list = $card.closest('.sp-faq-list');

        $list.find('.sp-faq-card').each(function () {
            if($(this).is($card)) { return; }
            $(this).find('> .card-contents').collapse('hide');
        });

        var collapse_action = $card.hasClass('card-open') ? 'hide' : 'show';
        $card.find('> .card-contents').collapse(collapse_action);
    });

})(jQuery);