<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<div class="sp-slick-testimonials <?php echo esc_attr( $el_class ); ?>">
	<?php foreach ( $slides as $slide ): ?>
		<div class="item">
			<div class="sp-testimonials-block">
				<div class="text"><?php echo do_shortcode( wp_kses_post( $slide['text'] ) ); ?></div>

				<?php if ( $slide['image'] ): ?>
					<div class="photo"><?php
						sp_theme_display_resized_image( $slide['image'], 80, 80 );
					?></div>
				<?php endif; ?>

				<h6 class="name"><?php echo wp_kses_post( $slide['author'] ); ?></h6>
			</div>
		</div>
	<?php endforeach; ?>
</div>