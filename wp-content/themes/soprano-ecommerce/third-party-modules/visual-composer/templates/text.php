<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

$elem_atts = array(
	'class' => 'sp-text-widget ' . $el_class,
	'style' => $custom_css ? $custom_css : false
); ?>

<div <?php echo html_build_attributes( $elem_atts ); ?>>
	<?php echo do_shortcode( wp_kses_post( wpautop( $text_p ) ) ); ?>
    <div class="sp-signature"><?php echo wp_kses_post( trim( $signature ) ); ?></div>
</div>