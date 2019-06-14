<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_Widgets {

	/**
	 * SopranoTheme_Widgets constructor
	 */
	function __construct() {
		add_action( 'widgets_init', array( $this, 'init_widget_areas' ) );
		add_action( 'widgets_init', array( $this, 'load_custom_widgets' ) );
	}


	/**
	 * Register widget areas
	 *
	 * @action widgets_init
	 */
	public function init_widget_areas() {
		register_sidebar( array(
			'name'          => esc_html__( 'Main Sidebar', 'soprano-ecommerce' ),
			'id'            => 'sp-main-sidebar',
			'description'   => esc_html__('Appears in the blog section and on simple static pages on the right side.','soprano-ecommerce'),
			'before_widget' => '<div id="%1$s" class="sp-widget-block %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar', 'soprano-ecommerce' ),
			'id'            => 'sp-footer-sidebar',
			'description'   => esc_html__('Appears at the footer area on the each page of your site.','soprano-ecommerce'),
			'before_widget' => '<div id="%1$s" class="sp-footer-widget col-lg-4 col-md-6 col-xs-12 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="title-block"><h4>',
			'after_title'   => '</h4></div>',
		) );

		if ( class_exists( 'WooCommerce' ) ) { // register additional sidebar just for woocommerce pages
			register_sidebar( array(
				'name'          => esc_html__( 'WooCommerce Sidebar', 'soprano-ecommerce' ),
				'id'            => 'sp-woo-sidebar',
				'description'   => esc_html__( 'Appears on the shop pages.', 'soprano-ecommerce' ),
				'before_widget' => '<div id="%1$s" class="sp-widget-block %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			) );
		}
	}


	/**
	 * Load custom widgets into the memory
	 *
	 * @action widgets_init
	 */
	public function load_custom_widgets() {
		$widgets_dir = get_parent_theme_file_path( '/internal/wp_widgets' );
		$found_files = glob( $widgets_dir . '/*.php' );

		if ( ! $found_files || ! is_array( $found_files ) ) {
			return;
		}

		foreach ( $found_files as $file ) {
			include $file;
		}
	}

}

new SopranoTheme_Widgets();