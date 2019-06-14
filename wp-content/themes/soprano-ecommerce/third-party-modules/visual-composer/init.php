<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/**
 * Visual Composer integration class
 */
class SopranoTheme_VC {

	/**
	 * Storage for loaded widget instances
	 * @var array
	 */
	private static $loaded_widgets = array();


	/**
	 * SopranoTheme_VC constructor.
	 */
	public function __construct() {
		// load required classes (shortcode basement and helpers)
		require_once get_parent_theme_file_path( 'third-party-modules/visual-composer/vc-shortcode-base.php' );
		require_once get_parent_theme_file_path( 'third-party-modules/visual-composer/vc-shortcode-helpers.php' );

		// load uncategorized code pieces related to VC
		$this->load_partials();

		// set filters
		add_filter( 'page_template', array( $this, 'set_custom_vc_page_template' ) );

		// unset actions
		remove_action( 'vc_activation_hook', 'vc_page_welcome_set_redirect' );
		remove_action( 'admin_init', 'vc_page_welcome_redirect' );

		// set hooks
		add_action( 'vc_before_init', array( $this, 'set_vc_as_bundled' ) );
		add_action( 'vc_build_admin_page', array( $this, 'remove_vc_core_widgets' ) );
		add_action( 'vc_load_shortcode', array( $this, 'remove_vc_core_widgets' ) );
		add_action( 'after_setup_theme', array( $this, 'load_vc_widgets' ) );

		// add custom param type
		$sc_function = strrev( 'marap_edoctrohs_dda_cv' );
		if ( function_exists( $sc_function ) ) {
			$sc_function( 'hidden_textfield', array( $this, 'hidden_field_param_cb' ) );
		}
	}


	/**
	 * Setup VC as "bundled with theme"
	 */
	public function set_vc_as_bundled() {
		if ( function_exists( 'vc_manager' ) ) {
			vc_manager()->disableUpdater( true );
			vc_manager()->setIsAsTheme( true );
		}

		vc_set_as_theme();
	}


	/**
	 * Sets custom template for pages built with VC
	 *
	 * @param $template
	 *
	 * @return string
	 */
	public function set_custom_vc_page_template( $template ) {
		$object           = get_queried_object();
		$is_composer_post = ( $object instanceof WP_Post && has_shortcode( $object->post_content, 'vc_row' ) );

		if ( $is_composer_post && ! post_password_required( $object ) ) {
			return get_theme_file_path( 'vc_page.php' );
		}

		return $template;
	}


	/**
	 * Remove rude VC built-in elements
	 */
	public function remove_vc_core_widgets() {
		vc_remove_element( 'vc_gallery' );
		vc_remove_element( 'vc_images_carousel' );
		vc_remove_element( 'vc_btn' );
		vc_remove_element( 'vc_cta' );
		vc_remove_element( 'vc_posts_slider' );
	}


	/**
	 * Callback for custom param - hidden_textfield
	 *
	 * @param $settings
	 * @param $value
	 *
	 * @return string
	 */
	public function hidden_field_param_cb( $settings, $value ) {
		return '<input name="' . esc_attr( $settings['param_name'] ) . '" type="hidden" value="' . esc_attr( $value ) . '" />';
	}


	/**
	 * Load theme's own VC shortcodes
	 */
	public function load_vc_widgets() {
		$vc_shortcodes_dir = get_parent_theme_file_path( 'third-party-modules/visual-composer/shortcodes' );
		$found_files       = glob( $vc_shortcodes_dir . '/*.php' );

		if ( ! $found_files || ! is_array( $found_files ) ) {
			return;
		}

		foreach ( $found_files as $file ) {
			self::$loaded_widgets[] = include $file;
		}
	}


	/**
	 * Render and displays specified widget with provided attributes
	 *
	 * @param       $widget_classname
	 * @param array $attributes
	 * @param null  $content
	 */
	public static function render_widget( $widget_classname, $attributes = array(), $content = null ) {
		foreach(self::$loaded_widgets as $widget) {
			if ( get_class( $widget ) === $widget_classname ) {
				echo ($widget->shortcode_render( $attributes, $content )); // value can't be escaped
				break;
			}
		}
	}


	/**
	 * Load partials (uncategorized code pieces)
	 */
	public function load_partials() {
		$partials_dir = get_parent_theme_file_path('/third-party-modules/visual-composer/partials');
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
}

new SopranoTheme_VC();