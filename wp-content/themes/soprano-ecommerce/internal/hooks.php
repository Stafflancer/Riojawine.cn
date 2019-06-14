<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/**
 * Module to load template blocks via get_template_part
 */
add_action( 'get_template_part_tpl-blocks', 'sp_theme_load_template_part', 10, 2 );
function sp_theme_load_template_part( $slug, $name ) {
	$file = '/tpl-blocks/' . basename( $name ) . '.php';
	$file = get_theme_file_path( $file );

	is_readable( $file ) && require $file;
}


/**
 * Set custom password protected form template
 */
add_filter( 'the_password_form', 'sp_theme_custom_password_form' );
function sp_theme_custom_password_form() {
	ob_start();
	get_template_part( 'tpl-blocks', 'password-protected-form' );

	return ob_get_clean();
}


/**
 * Control title format for password protected posts
 */
add_filter( 'protected_title_format', 'sp_theme_custom_protected_title_format', 10, 2 );
function sp_theme_custom_protected_title_format( $protected_title_format, $post ) {
	return ( is_singular() ) ? '%s' : $protected_title_format;
}


/**
 * Pass user-defined portfolio rewrite slug into CPTs plugin
 */
add_filter( 'pzt_cpt/slug/sp-portfolio', 'sp_theme_set_portfolio_slug' );
function sp_theme_set_portfolio_slug( $rewrite_slug ) {
	return sp_theme_opt( 'portfolio_slug_base', $rewrite_slug );
}


/**
 * Pass custom arguments to wp_link_pages function
 */
add_filter( 'wp_link_pages_args', 'sp_theme_wp_link_pages_args_filter' );
function sp_theme_wp_link_pages_args_filter( $args ) {
	$label = esc_html__( 'Pages:', 'soprano-ecommerce' );

	$args['before']      = '<p class="sp-link-pages">';
	$args['after']       = '</p>';
	$args['link_before'] = '<span class="page-link">';
	$args['link_after']  = '</span>';

	return $args;
}


/**
 * Excerpt control
 */
add_filter( 'excerpt_more', 'sp_theme_custom_excerpt_more' );
function sp_theme_custom_excerpt_more( $more ) {
	return '..';
}


/**
 * Enable shortcodes in text widgets
 */
add_filter( 'widget_text', 'do_shortcode' );


/**
 * Reorder comment form fields
 */
add_filter( 'comment_form_fields', 'sp_reorder_comment_fields' );
function sp_reorder_comment_fields( $fields ) {
	$new_fields = array();
	$myorder    = array( 'author', 'email', 'url', 'comment' );

	// change fields order on shop product pages
    if (function_exists('is_product') && is_product()) {
        $myorder = array('comment', 'author', 'email', 'url');
    }

	foreach ( $myorder as $key ) {
		if ( ! isset( $fields[ $key ] ) ) {
			continue;
		}

		$new_fields[ $key ] = $fields[ $key ];
		unset( $fields[ $key ] );
	}

	if ( $fields ) {
		foreach ( $fields as $key => $val ) {
			$new_fields[ $key ] = $val;
		}
	}

	return $new_fields;
}


/**
 * Custom settings for tags cloud widget
 */
add_filter( 'widget_tag_cloud_args', 'sp_theme_filter_tag_cloud_args' );
function sp_theme_filter_tag_cloud_args( $args ) {
	$args['smallest']  = 18;
	$args['largest']   = 32;
	$args['unit']      = 'px';
	$args['separator'] = ' ';

	return $args;
}


/**
 * Customizations for category listing widgets
 */
add_filter( 'wp_list_categories', 'sp_theme_custom_cat_list' );
function sp_theme_custom_cat_list( $links ) {
	$links = str_replace( '(', '<span class="cat">', $links );
	$links = str_replace( ')', '</span>', $links );

	return $links;
}


/**
 * Customizations for archive list widget
 */
add_filter( 'get_archives_link', 'sp_theme_custom_archives_link', 10, 6 );
function sp_theme_custom_archives_link( $link_html, $url, $text, $format, $before, $after ) {
	if ( $format === 'html' ) {
		$after = preg_replace( '/^(.*)\((\d+)\)$/s', '$1<span class="cat">$2</span>', $after );
		return '<li>' . $before . sp_theme_build_tag( 'a', array( 'href' => $url ), $text ) . $after . '</li>';
	} else {
		return $link_html;
	}
}


/**
 * Control post classes list
 */
add_filter( 'post_class', 'sp_theme_post_class_hook' );
function sp_theme_post_class_hook( $classes ) {
	if ( has_post_thumbnail() == false ) {
		$classes[] = 'no-thumbnail';
	}

	return $classes;
}