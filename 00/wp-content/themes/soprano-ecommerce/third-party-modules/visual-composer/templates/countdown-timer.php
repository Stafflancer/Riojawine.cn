<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

$elem_atts = array(
	'class'         => 'sp-countdown-block ' . $el_class,
	'data-deadline' => $final_date
); ?>

<div <?php echo html_build_attributes( $elem_atts ); ?>>
    <div class="remaining-timer weeks">
        <div class="count"></div>
        <div class="text"><?php esc_html_e( 'Weeks', 'soprano-ecommerce' ); ?></div>
    </div>

    <div class="remaining-timer days">
        <div class="count"></div>
        <div class="text"><?php esc_html_e( 'Days', 'soprano-ecommerce' ); ?></div>
    </div>

    <div class="remaining-timer hours">
        <div class="count"></div>
        <div class="text"><?php esc_html_e( 'Hours', 'soprano-ecommerce' ); ?></div>
    </div>

    <div class="remaining-timer minutes">
        <div class="count"></div>
        <div class="text"><?php esc_html_e( 'Minutes', 'soprano-ecommerce' ); ?></div>
    </div>

    <div class="remaining-timer seconds">
        <div class="count"></div>
        <div class="text"><?php esc_html_e( 'Seconds', 'soprano-ecommerce' ); ?></div>
    </div>
</div>


