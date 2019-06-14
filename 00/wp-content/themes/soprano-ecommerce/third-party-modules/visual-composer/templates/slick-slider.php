<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<?php $slider_el_atts = array(
	'class'      => 'sp-custom-slick ' . esc_attr( $el_class ),
	'data-slick' => json_encode( $slick_options ),
); ?>

<div <?php echo html_build_attributes( $slider_el_atts ); ?>>
	<?php foreach ( $slides as $slide ): ?>
        <div class="item">
			<?php sp_theme_display_image( $slide['image'], 'full' ); ?>
			<?php if ( trim( $slide['caption'] ) ): ?>
                <div class="slide-caption"><?php echo do_shortcode( wp_kses_post( $slide['caption'] ) ); ?></div>
			<?php endif; ?>
        </div>
	<?php endforeach; ?>
</div>