/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * Load theme fonts via WebFontLoader
 ***********************************************/
(function () {
    'use strict';

    WebFont.load({
        google: {families: PZTJS.phpData('theme_fonts')}
    });
})();