<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/**
 * This file represents sidebar area used on site pages
 */


$sidebar_id = isset( $template_args['sidebar-id'] ) ? $template_args['sidebar-id'] : 'sp-main-sidebar';
if ( ! sp_theme_is_active_sidebar( $sidebar_id ) ) { return; }

$sidebar_position = sp_theme_get_sidebar_position();
$sidebar_sticky   = sp_theme_sidebar_is_sticky();

$sidebar_classes = 'sp-sidebar';
if ( $sidebar_sticky ) {
	$sidebar_classes .= ' sticky';
} ?>

<div class="sidebar-column <?php echo esc_attr( $sidebar_position ); ?>">
	<div class="<?php echo esc_attr( $sidebar_classes ); ?>"><?php dynamic_sidebar( $sidebar_id ); ?></div>
</div>