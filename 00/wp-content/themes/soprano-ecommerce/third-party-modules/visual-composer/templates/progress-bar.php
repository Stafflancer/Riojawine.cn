<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<div class="sp-progress-bar <?php echo esc_attr( $el_class ); ?>" data-value="<?php echo esc_attr( $value ); ?>">
	<?php if ( $title ) : ?>
        <div class="title">
			<?php echo wp_kses_post( $title ); ?>
            <span class="progress-value"></span>
        </div>
	<?php endif; ?>

	<div class="progress">
		<div class="progress-bar"></div>
	</div>
</div>