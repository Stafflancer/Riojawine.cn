<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<?php $elem_atts = array(
	'class' => 'sp-quote-widget ' . esc_attr( $el_class ),
	'style' => ( trim( $text_color ) ) ? 'color: ' . esc_attr( $text_color ) : false
); ?>

<div <?php echo html_build_attributes( $elem_atts ); ?>>
    <div class="sp-quote"><?php echo wp_kses_post( wpautop( $text ) ); ?></div>
    <span class="sp-signature"><?php echo wp_kses_post( $name ); ?></span>
</div>