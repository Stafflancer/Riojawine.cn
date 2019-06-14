<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

// we don't need an attachment page, so we make redirect here
global $post;
$post_parent = $post->post_parent;

if ( property_exists( $post, 'guid' ) && is_string( $post->guid ) && trim( $post->guid ) ) {
	wp_redirect( $post->guid );
} else if ( $post_parent && $post_parent !== $post->ID ) {
	wp_redirect( get_permalink( $post_parent ) );
} else {
	$home_url = esc_url( home_url( '/' ) );
	wp_redirect( $home_url );
}