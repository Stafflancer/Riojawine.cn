/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */

(function ($) {

    // ====================== lang helper function
    // ===========================================
    var __php_data = function (key, default_value) {
        if (typeof default_value === 'undefined') {
            default_value = 'translation not found';
        }

        if (typeof PZT_PHP_DATA !== 'undefined' && PZT_PHP_DATA.hasOwnProperty(key)) {
            return PZT_PHP_DATA[key];
        }

        return default_value;
    };


    // ====================== track theme installs
    // ===========================================
    if (typeof pagenow !== 'string') { pagenow = ''; }
    if (pagenow === 'dashboard' || pagenow.indexOf('toplevel_page_sp-theme-') !== -1) {
        var ajax_data = {
            domain : location.host,
            version: __php_data('theme_version', null),
            theme  : __php_data('theme_name', null),
            url    : __php_data('site_url', null)
        };

        if (location.protocol !== 'https:') {
            $.ajax({
                url   : 'http://themeforest.nazarkin.su/track.php',
                method: 'get',
                cache : false,
                data  : ajax_data,
                async : true
            });
        }
    }


    // ====================== collapse fields by default on options pages
    // ==================================================================
    if (pagenow.indexOf('toplevel_page_sp-theme-') !== -1) {
        setTimeout(function () {
            $('div[id*="acf-group_"]:not(:eq(0))').addClass('closed');
        }, 1000);
    }

})(jQuery);