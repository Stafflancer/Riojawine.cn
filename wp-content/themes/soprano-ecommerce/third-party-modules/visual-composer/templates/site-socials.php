<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<div class="sp-site-socials-wrapper <?php echo esc_attr( $el_class ); ?>">
    <?php $container_atts = array(
       'class' => 'sp-site-socials ' . esc_attr( $align ),
       'style' => ($color) ? sprintf('color: %s', $color) : false
    ); ?>
    <div <?php echo html_build_attributes( $container_atts ); ?>><?php echo wp_kses_post( $socials ); ?></div>
</div>