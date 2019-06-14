<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/**
 * This file represents form for password protected pages or posts
 */

?>

<div class="sp-password-post">
	<p>
		<?php $custom_msg = sp_theme_post_opt( 'password_form_custom_message' );
		if ( $custom_msg ) {
			echo wp_kses_post( $custom_msg );
		} else {
			esc_html_e( 'This content is password protected. To view it please enter password below:', 'soprano-ecommerce' );
		} ?>
	</p>

	<form class="form password-protected" action="<?php echo esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) ?>" method="post">
		<input type="password" class="password-field" name="post_password" placeholder="<?php esc_attr_e( 'Type password here', 'soprano-ecommerce' ) ?>" autofocus>
		<input type="submit" class="password-submit" value="<?php esc_html_e( 'Enter', 'soprano-ecommerce' ); ?>">
	</form>
</div>