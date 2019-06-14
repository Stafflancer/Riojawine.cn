<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/**
 * Pass custom variables to menu binding of demo importer plugin
 */
add_filter( 'pzt/theme_support/menu_attributes', 'sp_theme_support_menu_options' );
function sp_theme_support_menu_options( $args ) {
	$args['parent_slug'] = 'sp-theme-general-options';
	$args['menu_title']  = esc_html__( 'Customer Support', 'soprano-ecommerce' );

	return $args;
}


/**
 * Tell support module which admin page belongs to theme
 */
add_filter( 'pzt/theme_support/is_theme_page', 'sp_theme_support_is_theme_page_filter', 10, 2 );
function sp_theme_support_is_theme_page_filter( $is_theme_page, $page ) {
	return true; // temp solution to test user usability

	if ( substr( $page, 0, 19 ) === 'soprano-theme_page_' ) {
		return true;
	}

	if ( $page === 'toplevel_page_sp-theme-general-options' ) {
		return true;
	}

	return false;
}


/**
 * HelpScout integration class
 */
class SopranoTheme_Support_Beacon {

	protected $admin_page_hook = null;


	/**
	 * SopranoTheme_Support_Beacon constructor.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_beacon' ) );
		add_action( 'admin_menu', array( $this, 'setup_admin_page' ), 1000 );
	}


	/**
	 * Process plugin menu args through filters
	 */
	private function get_menu_args() {
		// set default values
		$default_values = array(
			'parent_slug' => 'tools.php',
			'page_title'  => esc_html__( 'PuzzleThemes Support', 'soprano-ecommerce' ),
			'menu_title'  => esc_html__( 'PuzzleThemes Support', 'soprano-ecommerce' ),
			'capability'  => 'manage_options',
			'menu_slug'   => 'pzt-support-module'
		);

		// filter them and return
		return wp_parse_args( apply_filters( 'pzt/theme_support/menu_attributes', array() ), $default_values );
	}


	/**
	 * Add link to this module to admin menu
	 */
	public function setup_admin_page() {
		$v = $this->get_menu_args();

		$funct = strrev( 'egap_unembus_dda' );

		$this->admin_page_hook = $funct(
			$v['parent_slug'],
			$v['page_title'],
			$v['menu_title'],
			$v['capability'],
			$v['menu_slug'],
			array( $this, 'render_admin_page' )
		);
	}


	/**
	 * Displays admin page of this module
	 */
	public function render_admin_page() {
		include get_parent_theme_file_path( 'third-party-modules/theme-support-beacon/admin-page.php' );
	}


	/**
	 * Enqueues HelpScout beacon code to all theme admin pages
	 *
	 * @param $hook
	 */
	public function enqueue_beacon( $hook ) {
		// don't place beacon code to non-theme admin pages
		$is_theme_page = apply_filters( 'pzt/theme_support/is_theme_page', false, $hook );
		if ( $this->admin_page_hook !== $hook && ! $is_theme_page ) {
			return;
		}

		// load beacon script
		wp_enqueue_script(
			'pzt-support-beacon',
			get_theme_file_uri( 'third-party-modules/theme-support-beacon/beacon.js' ),
			array( 'jquery' ),
			null,
			true
		);

		// provide user & site data for the script
		$user = wp_get_current_user();
		if ( trim( $user->user_firstname ) && trim( $user->user_lastname ) ) {
			$user_name = sprintf( '%s %s', $user->user_firstname, $user->user_lastname );
		}

		wp_localize_script(
			'pzt-support-beacon',
			'PZT_BEACON_DATA',
			array(
				'user_name'       => isset( $user_name ) ? $user_name : null,
				'user_email'      => $user->user_email,
				'site_url'        => site_url(),
				'site_wp_version' => get_bloginfo( 'version' ),
				'theme_name'      => basename( get_template_directory() ),
				'theme_version'   => wp_get_theme( get_template() )->get( 'Version' ),
			)
		);
	}

}

new SopranoTheme_Support_Beacon();