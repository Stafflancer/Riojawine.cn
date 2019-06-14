<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Nazarkin Roman
 *  -----------------------------------
 *  PhoenixTeam, PuzzleThemes
 *  =================================== */


/**
 * Retrieve correct slug for specified post type
 *
 * @param $post_type
 * @param $default_slug
 *
 * @return mixed
 */
function pzt_get_correct_cpt_slug( $post_type, $default_slug ) {
	// get current slug
	$wp_filter_name  = sprintf( 'pzt_cpt/slug/%s', $post_type );
	$pt_current_slug = apply_filters( $wp_filter_name, $default_slug );

	// get old slug from db
	$wp_option_name = sprintf( 'pzt_%s_post_type_slug', $post_type );
	$db_pt_slug     = get_option( $wp_option_name, array() );

	// rebuild rewrite rules cache if post type slug was changed
	if ( $pt_current_slug !== $db_pt_slug ) {
		update_option( $wp_option_name, $pt_current_slug, true );
		flush_rewrite_rules();
	}

	return $pt_current_slug;
}