<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see           https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 *
 * @version      100.0
 * @orig_version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
/**
 * woocommerce_before_single_product hook.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
} ?>

<div id="product-<?php the_ID(); ?>" <?php post_class(); ?> data-sp-nojump="true">
    <?php woocommerce_show_product_images(); ?>

	<div class="summary entry-summary">
		<h3><?php echo get_the_title(); ?></h3>

		<div class="sp-woo-desc-single"><?php woocommerce_template_single_excerpt(); ?></div>
		<div class="sp-woo-price-single"><?php woocommerce_template_single_price(); ?></div>
		<div class="sp-woo-cart-single"><?php woocommerce_template_single_add_to_cart(); ?></div>
		<div class="sp-woo-meta-single"><?php woocommerce_template_single_meta(); ?></div>
		<div class="sp-woo-sharing-single"><?php woocommerce_template_single_sharing(); ?></div>

		<?php
		/**
		 * woocommerce_single_product_summary hook.
		 *
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>
	</div>

	<?php
	/**
	 * woocommerce_after_single_product_summary hook.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>