<?php ! defined( 'ABSPATH' ) AND exit;

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/**
 * Pass custom variables to menu binding of demo importer plugin
 */
add_filter( 'pzt/demo_importer/menu_attributes', 'sp_theme_importer_menu_options' );
function sp_theme_importer_menu_options( $args ) {
	$args['parent_slug'] = 'sp-theme-general-options';
	$args['menu_title']  = esc_html__( 'Demo Importer', 'soprano-ecommerce' );

	return $args;
}


/**
 * Detect CPT plugin
 */
add_filter( 'pzt/demo_importer/cpt_installed', 'sp_theme_is_cpt_installed' );
function sp_theme_is_cpt_installed() {
	return class_exists( 'SopranoTheme_CPTs' );
}


/**
 * Pass WXR files to the importer
 */
add_filter( 'pzt/demo_importer/wxr_files', 'sp_theme_import_wxr_files_filter' );
function sp_theme_import_wxr_files_filter( $import_files ) {
	$partials_dir = get_parent_theme_file_path( 'third-party-modules/demo-import/wxr-files' );
	$found_files  = glob( $partials_dir . '/*.xml' );

	// remove woocommerce demo data from import if plugin is inactive
	if ( ! class_exists( 'WooCommerce' ) ) {
		foreach ( $found_files as $ff_index => $found_file ) {
			if ( basename( $found_file ) === 'woocommerce.xml' ) {
				unset( $found_files[ $ff_index ] );
				break;
			}
		}
	}

	if ( ! $found_files || ! is_array( $found_files ) ) {
		return $import_files;
	}

	return array_merge( $import_files, $found_files );
}


/**
 * Pass Media WXR files to the importer
 */
add_filter( 'pzt/demo_importer/wxr_media_files', 'sp_theme_import_wxr_media_files_filter' );
function sp_theme_import_wxr_media_files_filter( $import_files ) {
	$partials_dir = get_parent_theme_file_path( 'third-party-modules/demo-import/wxr-media-files' );
	$found_files  = glob( $partials_dir . '/*.xml' );

	if ( ! $found_files || ! is_array( $found_files ) ) {
		return $import_files;
	}

	return array_merge( $import_files, $found_files );
}


/**
 * Pass widgets import files to the importer
 */
add_filter( 'pzt/demo_importer/wie_files', 'sp_theme_import_wie_files_filter' );
function sp_theme_import_wie_files_filter( $import_files ) {
	$partials_dir = get_parent_theme_file_path( 'third-party-modules/demo-import/wie-files' );
	$found_files  = glob( $partials_dir . '/*.wie' );

	if ( ! $found_files || ! is_array( $found_files ) ) {
		return $import_files;
	}

	return array_merge( $import_files, $found_files );
}


/**
 * Set menus to a proper locations
 */
add_filter( 'pzt/demo_importer/menus_by_locations', 'sp_theme_set_import_menus', 10, 2 );
function sp_theme_set_import_menus( $menus, $locations ) {
	$main_menu   = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	$footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
	$menu_404    = get_term_by( 'name', '404 Menu', 'nav_menu' );

	return array(
		'primary'  => ( $main_menu instanceof WP_Term ) ? $main_menu->term_id : null,
		'footer'   => ( $footer_menu instanceof WP_Term ) ? $footer_menu->term_id : null,
		'404-page' => ( $menu_404 instanceof WP_Term ) ? $menu_404->term_id : null,
	);
}


/**
 * Setup proper front page
 */
add_filter( 'pzt/demo_importer/front_page_id', 'sp_theme_set_frontpage_id' );
function sp_theme_set_frontpage_id() {
	$page = get_page_by_title( 'Slider Parallax' );
	return ( $page instanceof WP_Post ) ? $page->ID : null;
}


/**
 * Set proper posts page
 */
add_filter( 'pzt/demo_importer/posts_page_id', 'sp_theme_set_postspage_id' );
function sp_theme_set_postspage_id() {
	$page = get_page_by_title( 'Blog' );
	return ( $page instanceof WP_Post ) ? $page->ID : null;
}


/**
 * Update Visual Composer post types
 */
add_action( 'pzt/demo_importer/tunewp_finished', 'sp_theme_after_tunewp_action' );
function sp_theme_after_tunewp_action() {
	$role = get_role( 'administrator' );
	if ( $role instanceof WP_Role ) {
		$role->add_cap( 'vc_access_rules_post_types/page', true );
		$role->add_cap( 'vc_access_rules_post_types/sp-portfolio', true );
		$role->add_cap( 'vc_access_rules_post_types', 'custom' );
	}

	echo '<p>' . esc_html__( 'Visual Composer parameters tuned.', 'soprano-ecommerce' ) . '</p>';
}