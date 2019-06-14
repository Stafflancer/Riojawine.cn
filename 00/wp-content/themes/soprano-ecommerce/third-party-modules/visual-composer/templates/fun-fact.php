<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<div class="sp-animate-numbers <?php echo esc_attr( $el_class ); ?>">
	<h1 data-min="<?php echo wp_kses_post( $min ); ?>" data-max="<?php echo wp_kses_post( $number ); ?>" data-delay="<?php echo wp_kses_post( $delay ); ?>" data-increment="<?php echo wp_kses_post( $increment ); ?>" data-slno="0" class="roller-title-number-0"><?php echo wp_kses_post( $number ); ?></h1>
	<p><?php echo wp_kses_post( $title ); ?></p>
</div>