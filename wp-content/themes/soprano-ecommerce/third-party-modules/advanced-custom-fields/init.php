<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_ACF {

	/**
	 * SopranoTheme_ACF constructor.
	 */
	public function __construct() {
		// load fallback functions
		$file = 'third-party-modules/advanced-custom-fields/fallbacks.php';
		require_once get_parent_theme_file_path( $file );

		// attach events & filters
		add_action( 'after_setup_theme', array( $this, 'load_fields' ) );
		add_action( 'acf/init', array( $this, 'setup_updates' ) );
		add_filter( 'acf/settings/google_api_key', array( $this, 'set_google_api_key' ) );
		add_filter( 'acf/acf_field_fonticonpicker/settings', array( $this, 'register_theme_iconfont' ) );

		// reveal WP's native "custom fields" metabox:
		// add_filter( 'acf/settings/remove_wp_meta_box', '__return_false' );
	}


	/**
	 * Load fields into memory. It is important to do this after theme
	 * textdomain will be loaded.
	 *
	 * @action after_setup_theme
	 */
	public function load_fields() {
		require_once get_parent_theme_file_path( 'third-party-modules/advanced-custom-fields/fields.php' );
	}


	/**
	 * Setup ACF's updates management module to work with theme.
	 *
	 * @action acf/init
	 */
	public function setup_updates() {
		global $wp_filter;
		acf_update_setting( 'show_updates', false );

		// search for key and remove it
		$key = 'pre_set_site_transient_update_plugins';
		if ( ! is_array( $wp_filter )
		     || ! isset( $wp_filter[ $key ] )
		     || ! isset( $wp_filter[ $key ]->callbacks[10] )
		) {
			return;
		}

		foreach ( $wp_filter[ $key ]->callbacks[10] as $name => $callback ) {
			if ( substr( $name, - 20, 20 ) !== 'modify_plugin_update' ) {
				continue;
			}
			$wp_filter[ $key ]->remove_filter( $key, $name, 10 );
		}
	}


	/**
	 * Pass Google API key to ACF
	 *
	 * @filter acf/settings/google_api_key
	 *
	 * @return null|string
	 */
	public function set_google_api_key() {
		return sp_theme_opt( 'google_maps_api_key', null );
	}


	/**
	 * Register theme's own icon font in ACF
	 *
	 * @filter acf/acf_field_fonticonpicker/settings
	 *
	 * @param array $settings
	 *
	 * @return array
	 */
	public function register_theme_iconfont( $settings ) {
		$settings['config'] = get_theme_file_path( 'public/icon-font/config.json' );
		$settings['icons']  = get_theme_file_uri( 'public/icon-font/css/sp-theme-icons.css' );

		return $settings;
	}
}

new SopranoTheme_ACF();