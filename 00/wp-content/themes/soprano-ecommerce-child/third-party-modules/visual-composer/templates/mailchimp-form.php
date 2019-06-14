<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<form action="<?php echo esc_url( $form_url ); ?>" class="sp-subscribe-form <?php echo esc_attr( $el_class ); ?>">
	<div class="form-inner-wrap">
		<h3><?php echo wp_kses_post( $heading ); ?></h3>

		<?php if ( trim( $opening_text ) ) {
			echo wp_kses_post( wpautop( $opening_text ) );
		} ?>

		<div class="input-group">
			<input id="sp-subscribe-input" type="email" class="form-control" placeholder="<?php esc_attr_e( 'Your E-mail', 'soprano-ecommerce' ) ?>">
			<span class="input-group-btn">
                <button class="btn btn-primary outline" type="submit"><?php esc_html_e( 'Subscribe', 'soprano-ecommerce' ) ?></button>
            </span>
		</div>

		<?php if ( $hide_image !== 'yes' ) : ?>
            <img src="<?php echo esc_attr( get_theme_file_uri( 'public/images/mailchimp.png' ) ); ?>" alt="<?php esc_attr_e( 'Mailchimp logo', 'soprano-ecommerce' ); ?>">
		<?php endif; ?>
	</div>

	<div class="form-output"></div>
</form>
