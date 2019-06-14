<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );
$post_link = sp_theme_post_opt( 'link' );
if ( ! trim( $post_link ) ) {
	return;
} ?>

<div class="sp-blog-link">
    <a href="<?php echo esc_url( $post_link ); ?>" target="_blank"><?php echo esc_html( $post_link ); ?></a>
</div>