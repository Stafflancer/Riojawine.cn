<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/**
 * This file represents mailchimp subscription form shown on the archive/listing pages
 */

?>

<?php $form_options = get_field( 'mailchimp_subscription_form', 'options' );
if ( ! $form_options || ! isset( $form_options['enabled'] ) || ! $form_options['enabled'] ) {
	return;
} ?>

<section class="sp-section little bg-color-light text-center" id="sp-subscribe">
	<?php SopranoTheme_VC::render_widget( 'SopranoTheme_VC_Mailchimp_Form', $form_options ); ?>
</section>