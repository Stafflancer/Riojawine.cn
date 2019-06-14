<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 *
 * @version      100.0
 * @orig_version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * @var $product WC_Product
 */
global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

if ( ! is_singular() && sp_theme_is_active_sidebar( 'sp-woo-sidebar' ) ) {
	$post_col_classes = 'col-md-6 col-xs-12';
} else {
	$post_col_classes = 'col-lg-4 col-md-6 col-xs-12';
} ?>

<div class="<?php echo esc_attr( $post_col_classes ); ?>">
	<div <?php post_class( 'shop-item' ); ?>>
		<div class="sp-shop-thumbnail-block">
			<a href="<?php echo get_the_permalink() ?>">
				<?php $attachment_ids = $product->get_gallery_image_ids(); ?>
				<?php if ( isset( $attachment_ids[0] ) && $attachment_ids[0] != '' ) : ?>
					<div class="sp-first-image"><?php
                        echo woocommerce_get_product_thumbnail( 'large' );
                    ?></div>
					<div class="sp-second-image"><?php
                        echo wp_get_attachment_image( $attachment_ids[0], 'large' );
                    ?></div>
				<?php else: ?>
					<div class="sp-first-image sp-single-image">
						<?php echo woocommerce_get_product_thumbnail( 'large' ); ?>
					</div>
				<?php endif; ?>
			</a>

            <?php woocommerce_show_product_loop_sale_flash(); ?>

			<ul class="sp-shop-extra">
				<?php if ( $product->get_average_rating() > 0 ) : ?>
					<li>
						<div class="extra-icon"><i class="icon-star"></i></div>
						<span class="extra-content"><?php woocommerce_template_loop_rating(); ?></span>
					</li>
				<?php endif; ?>

				<li><?php woocommerce_template_loop_add_to_cart(); ?></li>
			</ul>
		</div>

		<h5><?php echo get_the_title(); ?></h5>

		<?php woocommerce_template_loop_price(); ?>
	</div>
</div>