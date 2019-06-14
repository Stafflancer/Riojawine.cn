<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<div class="sp-clients-block <?php echo esc_attr( $el_class ); ?>">
    <h4 class="client-title"><?php echo trim( wp_kses_post( $title ) ); ?></h4>

    <?php sp_theme_display_resized_image( $image, 280 ); ?>
	<?php echo wp_kses_post( wpautop( $text ) ); ?>

    <a href="<?php echo esc_url( $button_link ); ?>" class="btn btn-primary"><?php
        echo trim( wp_kses_post( $button_text ) );
    ?></a>
</div>