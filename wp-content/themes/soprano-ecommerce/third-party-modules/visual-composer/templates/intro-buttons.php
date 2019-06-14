<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<ul class="list-inline intro">
	<li><a href="<?php echo esc_url( $url_one ); ?>" class="btn btn-primary wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1.5s"><?php echo wp_kses_post( $button_one ); ?></a></li>
	<li><a href="<?php echo esc_url( $url_two ); ?>" class="btn btn-white wow fadeInRight" data-wow-duration="1s" data-wow-delay="1.5s"><?php echo wp_kses_post( $button_two ); ?></a></li>                                     
</ul>
