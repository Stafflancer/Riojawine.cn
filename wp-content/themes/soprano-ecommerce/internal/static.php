<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_Static {

	private $parent_theme_version;

	/**
	 * SopranoTheme_Static constructor.
	 */
	function __construct() {
		$parent_theme               = wp_get_theme( get_parent_theme_file_path( 'style.css' ) );
		$this->parent_theme_version = $parent_theme->get( 'Version' );

		add_action( 'wp_enqueue_scripts', array( $this, 'equip_frontend_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'equip_frontend_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'pass_php_data_to_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_unneeded' ), 10000 );

		add_action( 'wp_scss_variables', array( $this, 'pass_php_data_to_styles' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'equip_admin_static' ), 10000 );
	}


	/**
	 * Removes ACF's font handle from loading queue since we're loading fonts via WebFontLoader
	 * Removes Visual Composer's version of animate-css since we're shipping our own customized
	 *
	 * @action wp_enqueue_scripts
	 */
	public function dequeue_unneeded() {
		wp_dequeue_style( 'acfgfs-enqueue-fonts' );
		wp_dequeue_style( 'acf-fonticonpicker-icons' );
		wp_dequeue_style( 'animate-css' );
		wp_deregister_style( 'animate-css' );
	}


	/**
	 * Enqueue theme style files
	 *
	 * @action wp_enqueue_scripts
	 */
	public function equip_frontend_styles() {
		// css bootstrap file
		wp_enqueue_style(
			'bootstrap',
			get_parent_theme_file_uri( 'public/styles/bootstrap.scss' ),
			array(),
			$this->parent_theme_version
		);

		// primary theme styles
		wp_enqueue_style(
			'sp-theme-primary-styles',
			get_parent_theme_file_uri( 'public/styles/main.scss' ),
			array(),
			$this->parent_theme_version
		);

		// theme icon font
		wp_enqueue_style(
			'sp-theme-icons',
			get_theme_file_uri( 'public/icon-font/css/sp-theme-icons.css' ),
			array(),
			$this->parent_theme_version
		);

		// parent theme's style.css
		wp_enqueue_style(
			'sp-theme-secondary-styles',
			get_parent_theme_file_uri( '/style.css' ),
			array(),
			$this->parent_theme_version
		);
	}


	/**
	 * Equip styles & scripts for the Dashboard
	 *
	 * @action admin_enqueue_scripts
	 */
	public function equip_admin_static() {
		wp_enqueue_style(
			'sp-theme-admin-styles',
			get_parent_theme_file_uri( 'internal/admin_static/styles.css' ),
			array(),
			filemtime( get_parent_theme_file_path( 'internal/admin_static/styles.css' ) )
		);

		wp_enqueue_script(
			'sp-theme-admin-scripts',
			get_parent_theme_file_uri( 'internal/admin_static/scripts.js' ),
			array( 'jquery' ),
			filemtime( get_parent_theme_file_path( 'internal/admin_static/scripts.js' ) )
		);

		wp_localize_script(
			'sp-theme-admin-scripts',
			'PZT_PHP_DATA',
			array(
				'theme_version' => wp_get_theme( get_template() )->get( 'Version' ),
				'theme_name'    => basename( get_template_directory() ),
				'site_url'      => site_url()
			)
		);
	}


	/**
	 * Equip theme scripts
	 *
	 * @action wp_enqueue_scripts
	 */
	public function equip_frontend_scripts() {
		// ie fallback styles
		wp_enqueue_script(
			'sp-theme-scripts/ie_fallback.js',
			get_theme_file_uri( 'public/scripts/ie_fallback.js' )
		);
		wp_script_add_data(
			'sp-theme-scripts/ie_fallback.js',
			'conditional',
			'lt IE 9'
		);

		// load WP internal scripts for comments functionality
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// load modernizr first
		wp_enqueue_script(
			'sp-theme-scripts/modernizr.js',
			get_parent_theme_file_uri( 'public/scripts/modernizr.js' ),
			array( 'jquery' ),
			$this->parent_theme_version,
			true
		);

		// then load all scripts from directories
		$this->equip_scripts_from_directory('public/scripts/assets');
		$this->equip_scripts_from_directory('public/scripts/bootstrap');
		$this->equip_scripts_from_directory('public/scripts/controllers');
	}


	/**
	 * Pass PHP data to the front-end scripts
	 *
	 * @action wp_enqueue_scripts
	 */
	public function pass_php_data_to_scripts() {
		$theme_font_families = $this->get_theme_fonts();

		// build fonts array
		foreach ( $theme_font_families as &$font ) {
			foreach ( $font['variants'] as &$v_str ) {
				$v_str = str_replace( 'regular', '400', $v_str );
				if ( trim( $v_str ) === 'italic' ) {
					$v_str = '400i';
				}
			}

			$font = $font['font'] . ':' . join( ',', $font['variants'] ) . ':' . join( ',', $font['subsets'] );
		}

		wp_localize_script(
			'sp-theme-scripts/modernizr.js',
			'PZT_PHP_DATA',
			array(
				'assets_dir'          => get_theme_file_uri( '/public' ),
				'theme_fonts'         => array_values( $theme_font_families ),
				'google_maps_api_key' => sp_theme_opt( 'google_maps_api_key', null )
			)
		);
	}


	/**
	 * Pass PHP data to the SCSS file sources
	 *
	 * @action wp_enqueue_scripts
	 *
	 * @param $vars
	 *
	 * @return array
	 */
	public function pass_php_data_to_styles( $vars ) {
		if ( ! is_array( $vars ) ) { $vars = array(); }

		// service vars
		$vars['assetsdir'] = '"' . get_theme_file_uri('public/') . '"';

		// theme colors
		$this->maybe_assert_var('brand-primary', sp_theme_opt( 'primary_color' ), $vars);
		$this->maybe_assert_var('body-color', sp_theme_opt( 'body_text_color' ), $vars);
		$this->maybe_assert_var('body-bg', sp_theme_opt( 'body_bg_color' ), $vars);

		// theme fonts
		$theme_fonts = $this->get_theme_fonts();
		$this->maybe_assert_var('theme-primary-font', $theme_fonts['primary']['font'], $vars);
		$this->maybe_assert_var('theme-headings-font', $theme_fonts['headings']['font'], $vars);

		// footer customizations
		$this->maybe_assert_var( 'footer-bg', sp_theme_opt( 'footer_background_color' ), $vars );
		$this->maybe_assert_var( 'footer-text-color', sp_theme_opt( 'footer_text_color' ), $vars );
		$this->maybe_assert_var( 'footer-link-color', sp_theme_opt( 'footer_links_color' ), $vars );

		return $vars;
	}


	/**
	 * Generates theme fonts array to use in WebFontLoader
	 *
	 * @return array
	 */
	private function get_theme_fonts() {
		$theme_font_families = array(
			'primary' => shortcode_atts(
				array(
					'font'     => 'Source Sans Pro',
					'variants' => array( 400, '400i', 600, '600i', 700, '700i' ),
					'subsets'  => array( 'latin' )
				),
				sp_theme_opt( 'primary_font', array() )
			),

			'headings' => shortcode_atts(
				array(
					'font'     => 'Montserrat',
					'variants' => array( 400, 500, 700 ),
					'subsets'  => array( 'latin' )
				),
				sp_theme_opt( 'headings_font', array() )
			),

			// this font comes by default without option to change
			'accent' => array(
				'font'     => 'Shadows Into Light',
				'variants' => array( 400 ),
				'subsets'  => array( 'latin' )
			),
		);

		return $theme_font_families;
	}


	/**
	 * Equip all scripts from specified directory
	 *
	 * @param $theme_dir
	 */
	private function equip_scripts_from_directory( $theme_dir ) {
		$folder_path     = rtrim( get_parent_theme_file_path( $theme_dir ), '/' ) . '/';
		$folder_uri      = rtrim( get_parent_theme_file_uri( $theme_dir ), '/' ) . '/';
		$scripts_pattern = $folder_path . '*.js';
		$found_scripts   = glob( $scripts_pattern );

		// exit if no files was found
		if ( ! is_array( $found_scripts ) || empty( $found_scripts ) ) {
			return;
		}

		$public_folder_path = get_parent_theme_file_path( '/public/' );
		foreach ( $found_scripts as $script ) {
			if ( ! is_file( $script ) ) { continue; } // filter non-existing files

			$ver    = $this->get_file_version( $script );
			$handle = str_replace( $public_folder_path, '', $script );
			$handle = 'sp-theme-scripts/' . strtolower( $handle );
			$src    = str_replace( $folder_path, $folder_uri, $script );

			wp_enqueue_script( $handle, $src, array( 'jquery' ), $ver, true );
		}
	}


	/**
	 * Get correct file version
	 *
	 * @param $path
	 *
	 * @return bool|false|int|string
	 */
	private function get_file_version( $path ) {
		return ( defined( 'PZT_DEV_ENV' ) ) ? filemtime( $path ) : $this->parent_theme_version;
	}


	/**
	 * Helper function for asserting SCSS values
	 *
	 * @param $var_name
	 * @param $var_value
	 * @param $var_array
	 */
	private function maybe_assert_var( $var_name, $var_value, &$var_array ) {
		if ( ! $var_value ) { return; }
		$var_array[$var_name] = $var_value;
	}

}

new SopranoTheme_Static();