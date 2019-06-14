<?php

/*
Plugin Name: Advanced Custom Fields: Google Font Selector
Plugin URI: https://github.com/danielpataki/ACF-Google-Font-Selector
Description: A field for Advanced Custom Fields which allows users to select Google fonts with advanced options
Version: 3.1.5
Author: Daniel Pataki
Author URI: http://danielpataki.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Include Common Functions
include_once('functions.php');


add_action('plugins_loaded', 'acfgfs_load_textdomain');
/**
 * Load Text Domain
 *
 * Loads the textdomain for translations
 *
 * @author Daniel Pataki
 * @since 3.0.0
 *
 */
function acfgfs_load_textdomain() {
	load_plugin_textdomain( 'acf-google-font-selector-field', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );
}


add_action('acf/include_field_types', 'include_field_types_google_font_selector');
/**
 * ACF 5 Field
 *
 * Loads the field for ACF 5
 *
 * @author Daniel Pataki
 * @since 3.0.0
 *
 */
function include_field_types_google_font_selector( $version ) {
	include_once('acf-google_font_selector-v5.php');
}