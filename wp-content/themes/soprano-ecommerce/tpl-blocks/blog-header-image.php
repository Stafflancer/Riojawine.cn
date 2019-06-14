<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );
$post_image = intval( sp_theme_post_opt( 'image' ) );
if ( ! $post_image ) {
	return;
} ?>

<div class="sp-blog-image">
	<?php sp_theme_display_image( $post_image, 'large' ); ?>
	<span class="caption"><?php echo wp_kses_post( sp_theme_post_opt( 'caption', '' ) ); ?></span>
</div>