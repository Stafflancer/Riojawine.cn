<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );
/*
	Plugin Name: Soprano Theme - Custom Post Types
	Plugin URI: http://puzzlethemes.net/
	Description: Theme-specific post type definitions.
	Version: 1.0.2
	Author: PuzzleThemes
	Author URI: http://puzzlethemes.net/
	License: GPLv2
*/

class SopranoTheme_CPTs {

	/**
	 * SopranoTheme_CPTs constructor.
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_action( 'init', array( $this, 'load_cpts' ), 9 );
	}


	/**
	 * Load plugin translations
	 */
	public function load_textdomain() {
		$lng_dir = plugin_basename( dirname( __FILE__ ) ) . '/languages';
		load_plugin_textdomain( 'sp-theme-cpt', false, $lng_dir );
	}


	/**
	 * Load custom post type definitions one-by-one
	 */
	public function load_cpts() {
		include_once dirname( __FILE__ ) . '/functions.php';

		$pt_dir      = dirname( __FILE__ ) . '/post-types/';
		$found_files = glob( $pt_dir . '*.php' );

		if ( ! $found_files || ! is_array( $found_files ) ) {
			return;
		}

		$include_isolated_callable = create_function( '$path', 'include $path;' );
		foreach ( $found_files as $file ) {
			call_user_func( $include_isolated_callable, $file );
		}
	}
}

new SopranoTheme_CPTs();