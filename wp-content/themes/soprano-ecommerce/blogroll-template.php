<?php
/**
 * Template name: Blogroll Page
 */
! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );
get_header();

global $wp_query;
$original_page_id = get_the_ID();

if ( ! is_home() ) {
    $sp_theme_paged = (int) get_query_var( 'paged', 1 );
    if ( $sp_theme_paged <= 0 ) { $sp_theme_paged = 1; }

    $args = array(
        'post_type'   => 'post',
        'post_status' => 'publish',
        'paged'       => $sp_theme_paged
    );

    if ( sp_theme_post_opt( 'posts_per_page' ) ) {
        $args['posts_per_page'] = sp_theme_post_opt( 'posts_per_page' );
    }

    query_posts( $args );

    $wp_query->queried_object_id = $original_page_id;
    $wp_query->queried_object    = get_post( $original_page_id );
}

get_template_part('archive');

wp_reset_query(); get_footer();