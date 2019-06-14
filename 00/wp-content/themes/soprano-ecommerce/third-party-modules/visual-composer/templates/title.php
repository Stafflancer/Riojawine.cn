<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<?php $title_atts = array(
	'class' => 'sp-title-block ' . esc_attr( $el_class ),
); ?>

<div <?php echo html_build_attributes( $title_atts ); ?>>
    <span><?php echo trim( wp_kses_post( $sub_title ) ); ?></span>
    <h3><?php echo do_shortcode( wp_kses_post( trim( $title ) ) ); ?></h3>
</div>