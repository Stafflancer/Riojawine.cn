<?php 
update_option( 'siteurl', 'http://riojawine.cn/' );
update_option( 'home', 'http://riojawine.cn/' );
! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/**
 * Theme defaults
 */
define( 'ACF_LITE', ! defined( 'PZT_DEV_ENV' ) );


/**
 * Load theme assets
 */
include get_parent_theme_file_path( 'internal/theme-setup.php' );
include get_parent_theme_file_path( 'internal/helpers.php' );
include get_parent_theme_file_path( 'internal/hooks.php' );
include get_parent_theme_file_path( 'internal/widgets.php' );
include get_parent_theme_file_path( 'internal/static.php' );


/**
 * Third-party modules
 */
include get_parent_theme_file_path( 'third-party-modules/advanced-custom-fields/init.php' );
include get_parent_theme_file_path( 'third-party-modules/tgmpa/init.php' );
include get_parent_theme_file_path( 'third-party-modules/scss-compiler/init.php' );
include get_parent_theme_file_path( 'third-party-modules/visual-composer/init.php' );
include get_parent_theme_file_path( 'third-party-modules/demo-import/init.php' );
include get_parent_theme_file_path( 'third-party-modules/theme-support-beacon/init.php' );
include get_parent_theme_file_path( 'third-party-modules/feedback-teaser/init.php' );
include get_parent_theme_file_path( 'third-party-modules/woocommerce/init.php' );

//Quitar las query strings from statics resources
function _remove_script_version( $src ){
$parts = explode( '?ver', $src );
return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
