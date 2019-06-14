<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_WooCommerce {

	/**
	 * SopranoTheme_WooCommerce constructor.
	 */
	public function __construct() {
		// setup actions
		add_action( 'after_setup_theme', array( $this, 'declare_support' ) );

		// remove unneeded actions
		$this->remove_actions();

		// setup filters
		add_filter( 'woocommerce_template_path', array( $this, 'woo_filter_template_path' ) );
		add_filter( 'woocommerce_product_single_add_to_cart_text', array( $this, 'woo_custom_cart_button_text' ), 10, 2 );
		add_filter( 'woocommerce_product_add_to_cart_text', array( $this, 'woo_custom_cart_button_text' ), 10, 2 );
		add_filter( 'post_class', array( $this, 'woo_filter_post_classname' ), 10, 3 );
		add_filter( 'loop_shop_per_page', array( $this, 'woo_custom_products_per_page' ), 20 );
		add_filter( 'woocommerce_output_related_products_args', array( $this, 'woo_custom_related_products_args' ) );
		add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'woo_custom_add_to_cart_fragments' ) );
	}


	/**
	 * Declare theme support
	 */
	public function declare_support() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-slider' );
		// add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
	}


	/**
	 * Define custom WooCommerce template files location
	 *
	 * @return string
	 */
	public function woo_filter_template_path() {
		return 'third-party-modules/woocommerce/templates/';
	}


	/**
	 * Removes unneeded WooCommerce actions
	 */
	public function remove_actions() {
		$unneeded_actions = array(
            array('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display'),
            array('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20),
            array('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5),
            array('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10),
            array('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10),
            array('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20),
            array('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30),
            array('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40),
            array('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50)
		);

		foreach ( $unneeded_actions as $action ) {
			call_user_func_array( 'remove_action', $action );
		}
	}


	/**
	 * Add custom fragments to cart update ajax call
	 *
	 * @param $fragments array
	 *
	 * @return mixed
	 */
	public function woo_custom_add_to_cart_fragments( $fragments ) {
		ob_start();
		get_template_part( 'tpl-blocks', 'woocommerce-mini-cart' );
		$fragments['#sp-woo-mini-cart'] = ob_get_clean();

		return $fragments;
	}


	/**
	 * Mess with count of related products to show
	 *
	 * @param $args
	 *
	 * @return mixed
	 */
	public function woo_custom_related_products_args( $args ) {
		$options_value = sp_theme_opt( 'related_products_count', 3 );
		if ( $options_value ) {
			$args['posts_per_page'] = $options_value;
		}

		return $args;
	}


	/**
	 * Change default count of products being shown on archive listings
	 *
	 * @param $products
	 *
	 * @return mixed
	 */
	public function woo_custom_products_per_page( $products ) {
		$options_value = sp_theme_opt( 'products_per_page' );
		if ( $options_value ) {
			$products = $options_value;
		}

		return $products;
	}


	/**
	 * Add "in-cart" class to items from cart
	 *
	 * @param $classnames
	 * @param $add_class
	 * @param $current_id
	 *
	 * @return array
	 */
	public function woo_filter_post_classname( $classnames, $add_class, $current_id ) {
		if ( self::is_product_in_cart( $current_id ) )  {
			$classnames[] = 'in-cart';
		}

		return $classnames;
	}


	/**
	 * Change the "add to cart" text on products if item is already in a cart
	 *
	 * @param $text
	 * @param $product WC_Product
	 *
	 * @return string
	 */
	public function woo_custom_cart_button_text( $text, $product ) {
		$current_id = $product->get_id();
		$queried_id = get_queried_object_id();

		if ( self::is_product_in_cart( $current_id ) ) {
			if ( is_singular() && $queried_id === $current_id ) {
				return esc_html__( 'Already in cart, add again?', 'soprano-ecommerce' );
			} else {
				return esc_html__( 'Already in cart', 'soprano-ecommerce' );
			}
		}

		return $text;
	}


	/**
	 * Checks whether specified product is already in cart
	 *
	 * @param $product_id
	 *
	 * @return bool
	 */
	static public function is_product_in_cart( $product_id ) {
		// check if plugin is installed
		if ( ! class_exists( 'WooCommerce' ) ) {
			return false;
		}

		// cart should be initialised
		if ( ! WC()->cart ) {
			return false;
		}

		// loop through cart items to check whether one of them is specified
		foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
			if ( $product_id == $values['product_id'] ) {
				return true;
			}
		}

		return false;
	}

}

new SopranoTheme_WooCommerce();