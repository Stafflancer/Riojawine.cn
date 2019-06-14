<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
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
 * @version         100.0
 * @orig_version    3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @var $product WC_Product
 */
global $product;

if ( SopranoTheme_WooCommerce::is_product_in_cart( $product->get_id() ) ) {
	echo apply_filters( 'woocommerce_loop_add_to_cart_link',
		sprintf( '<div class="extra-icon"><i class="icon-basket"></i></div><div class="extra-content"><a rel="nofollow" href="%s" class="%s">%s</a></div>',
			esc_url( wc_get_cart_url() ),
			esc_attr( 'added_to_cart' ),
			esc_html( $product->add_to_cart_text() )
		),
		$product );
} else {
	echo apply_filters( 'woocommerce_loop_add_to_cart_link',
		sprintf( '<div class="extra-icon"><i class="icon-basket"></i></div><div class="extra-content"><a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a></div>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $quantity ) ? $quantity : 1 ),
			esc_attr( $product->get_id() ),
			esc_attr( $product->get_sku() ),
			esc_attr( isset( $class ) ? $class : 'button' ),
			esc_html( $product->add_to_cart_text() )
		),
		$product );
}
