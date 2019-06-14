<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Nazarkin Roman
 *  -----------------------------------
 *  PhoenixTeam, PuzzleThemes
 *  =================================== */


// setup basic post type options
$args = array(
	'label'       => esc_html__( 'Portfolio', 'sp-theme-cpt' ),
	'labels'      => array(
		'add_new_item' => esc_html__( 'Add new portfolio item', 'sp-theme-cpt' ),
		'add_new'      => esc_html__( 'Add new', 'sp-theme-cpt' )
	),
	'public'      => true,
	'has_archive' => false,
	'menu_icon'   => 'dashicons-schedule',
	'rewrite' => array(
		'slug' => pzt_get_correct_cpt_slug( 'sp-portfolio', 'portfolio' )
	),
	'supports'    => array(
		'title',
		'editor',
		'revisions',
		'thumbnail',
	    'excerpt'
	)
);

// register post type
register_post_type( 'sp-portfolio', $args );

// portfolio tags
register_taxonomy(
	'sp-portfolio-tag',
	'sp-portfolio',
	array(
		'hierarchical'  => false,
		'public'        => false,
		'show_ui'       => true,
		'label'         => esc_html__( 'Tags', 'sp-theme-cpt' ),
		'singular_name' => esc_html__( 'Tag', 'sp-theme-cpt' ),
	)
);