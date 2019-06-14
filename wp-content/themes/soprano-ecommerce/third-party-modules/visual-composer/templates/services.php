<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<div class="sp-services-block <?php echo esc_attr( $el_class ); ?>">
	<div class="icon"><i class="<?php echo wp_kses_post( $icon ); ?>"></i></div>
	<div class="title"><h4><?php echo wp_kses_post( $title ); ?></h4></div>
	<p class="text"><?php echo wp_kses_post( $text ); ?></p>
</div>