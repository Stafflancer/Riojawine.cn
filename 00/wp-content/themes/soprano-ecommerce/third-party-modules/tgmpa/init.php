<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/**
 * Load TGMPA Library
 */
require_once get_parent_theme_file_path( 'third-party-modules/tgmpa/class-tgm-plugin-activation.php' );


/**
 * Initialize it
 */
add_action( 'tgmpa_register', 'sp_theme_register_required_plugins' );
function sp_theme_register_required_plugins() {
	$plugins = array(
		// THEME PLUGINS
		array(
			'name'     => 'Soprano Theme - Custom Post Types',
			'slug'     => 'soprano-theme-cpts',
			'source'   => 'soprano-theme-cpts.zip',
			'required' => true
		),
		array(
			'name'   => 'PuzzleThemes Demo Import Wizard (one-click import)',
			'slug'   => 'pzt-demo-import-wizard',
			'source' => 'pzt-demo-import-wizard.zip',
		),

		// REQUIRED PLUGINS
		array(
			'name'     => 'Visual Composer: Page Builder for WordPress',
			'slug'     => 'js_composer',
			'source'   => 'js_composer.zip',
			'version'  => '5.4.7',
			'required' => true
		),

		array(
			'name'     => 'Advanced Custom Fields PRO',
			'slug'     => 'advanced-custom-fields-pro',
			'source'   => 'advanced-custom-fields-pro.zip',
			'version'  => '5.6.9',
			'required' => true
		),

		// ACF EXTENSIONS
		array(
			'name'     => 'Advanced Custom Fields: Google Font Selector',
			'slug'     => 'acf-google-font-selector-field',
			'source'   => 'acf-google-font-selector-field.zip',
			'required' => true
		),

		array(
			'name'     => 'Advanced Custom Fields: FontIconPicker',
			'slug'     => 'acf-fonticonpicker',
			'source'   => 'acf-fonticonpicker.zip',
			'required' => true
		),

		// RECOMMENDED PLUGINS
		array(
			'name'     => 'WooCommerce',
			'slug'     => 'woocommerce',
			'required' => false
		),

		array(
			'name'     => 'WP Instagram Widget',
			'slug'     => 'wp-instagram-widget',
			'required' => false
		),

		array(
			'name'     => 'WP-PostViews',
			'slug'     => 'wp-postviews',
			'required' => false
		),

		array(
			'name'     => 'PuzzleThemes Twitter Feed Widget',
			'slug'     => 'pzt-twitter-feed-widget',
			'source'   => 'pzt-twitter-feed-widget.zip',
			'required' => false
		),

		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => false
		),
	);

	$config = array(
		'id'           => 'soprano-pro-theme',
		'default_path' => get_parent_theme_file_path( 'third-party-modules/tgmpa/plugins/'),
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => true,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}