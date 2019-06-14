<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/**
 * This file represents WooCommerce mini cart which is displayed in header
 */

$wc_cart = wc()->cart;

?>

<div class="sp-shop-icon woocommerce" id="sp-woo-mini-cart">
	<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="hover-icon">
		<i class="icon-ion-bag"></i>
		<span class="cart-badge"><?php echo esc_html( $wc_cart->get_cart_contents_count() ); ?></span>
	</a>

	<div class="hover-cart-wrap">
		<div class="hover-cart-contents"><?php woocommerce_mini_cart(); ?></div>
	</div>
</div>
