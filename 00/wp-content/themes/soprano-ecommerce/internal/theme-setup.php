<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_Setup {

	/**
	 * SopranoTheme_Setup constructor
	 */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'load_textdomain' ) );
		add_action( 'after_setup_theme', array( $this, 'add_supports' ) );
		add_action( 'after_setup_theme', array( $this, 'set_content_width' ) );
		add_action( 'after_setup_theme', array( $this, 'register_navs' ) );
		add_action( 'after_setup_theme', array( $this, 'register_image_sizes' ) );

		$this->setup_option_pages();
		$this->load_partials();
	}


	/**
	 * Make theme available for translation
	 */
	public function load_textdomain() {
		load_theme_textdomain( 'soprano-ecommerce', get_template_directory() . '/languages' );
	}


	/**
	 * Declare theme supported features
	 */
	public function add_supports() {
		// add RSS feed links to <head> for posts and comments
		add_theme_support( 'automatic-feed-links' );

		// enable title-tag functionality
		add_theme_support( 'title-tag' );

		// enable featured image support
		add_theme_support( 'post-thumbnails' );

		// enable post formats support
		add_theme_support(
			'post-formats',
			array( 'link', 'gallery', 'image', 'quote', 'video', 'audio' )
		);

		// switch default core markup to html5 in common places
		add_theme_support(
			'html5',
			array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' )
		);
	}


	/**
	 * Declare required image sizes
	 */
	public function register_image_sizes() {
		add_image_size( 'sp-section-bg', 1920 );
		add_image_size( 'sp-blog-preview', 660 );
	}


	/**
	 * Set proper site container's width
	 */
	public function set_content_width() {
		$GLOBALS['content_width'] = 1110;
	}


	/**
	 * Declare theme's own menu locations
	 */
	public function register_navs() {
		$menus = array(
			'primary'  => esc_html__( 'Primary header menu', 'soprano-ecommerce' ),
			'footer'   => esc_html__( 'Footer menu', 'soprano-ecommerce' ),
			'404-page' => esc_html__( '404 page menu', 'soprano-ecommerce' )
		);

		register_nav_menus( $menus );
	}


	/**
	 * Load partials (uncategorized code pieces)
	 */
	public function load_partials() {
		$partials_dir = get_parent_theme_file_path('/internal/partials');
		$found_files  = glob( $partials_dir . '/*.php' );

		// previously was `create_function( '$path', 'include $path;' )`
		$include_isolated_callable = function($path) {
			include $path;
		};

		if ( ! $found_files || ! is_array( $found_files ) ) {
			return;
		}

		foreach ( $found_files as $file ) {
			call_user_func( $include_isolated_callable, $file );
		}
	}


	/**
	 * Register theme option pages in ACF
	 */
	public function setup_option_pages() {
		if ( ! function_exists( 'acf_add_options_page' ) || ! function_exists( 'acf_add_options_sub_page' ) ) {
			return;
		}

		// NOTE: `acf_add_options_page` and `acf_add_options_sub_page` is a internal functions of ACF plugin
		// and it is required to use them instead of `add_theme_page`

		acf_add_options_page( array(
			'menu_title' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'menu_slug'  => 'sp-theme',
			'capability' => 'manage_options',
			'position'   => 100
		) );

		acf_add_options_sub_page( array(
			'parent_slug' => 'sp-theme',
			'menu_title'  => esc_html__( 'General Options', 'soprano-ecommerce' ),
			'page_title'  => esc_html__( 'General Options', 'soprano-ecommerce' ),
			'menu_slug'   => 'sp-theme-general-options',
			'capability'  => 'manage_options'
		) );

		acf_add_options_sub_page( array(
			'parent_slug' => 'sp-theme',
			'menu_title'  => esc_html__( 'Header', 'soprano-ecommerce' ),
			'page_title'  => esc_html__( 'Header Options', 'soprano-ecommerce' ),
			'menu_slug'   => 'sp-theme-header-options',
			'capability'  => 'manage_options'
		) );

		acf_add_options_sub_page( array(
			'parent_slug' => 'sp-theme',
			'menu_title'  => esc_html__( 'Footer', 'soprano-ecommerce' ),
			'page_title'  => esc_html__( 'Footer Options', 'soprano-ecommerce' ),
			'menu_slug'   => 'sp-theme-footer-options',
			'capability'  => 'manage_options'
		) );

		acf_add_options_sub_page( array(
			'parent_slug' => 'sp-theme',
			'menu_title'  => esc_html__( 'Theme Extras', 'soprano-ecommerce' ),
			'page_title'  => esc_html__( 'Theme Extras Settings', 'soprano-ecommerce' ),
			'menu_slug'   => 'sp-theme-extras-options',
			'capability'  => 'manage_options'
		) );
	}
}

new SopranoTheme_Setup();