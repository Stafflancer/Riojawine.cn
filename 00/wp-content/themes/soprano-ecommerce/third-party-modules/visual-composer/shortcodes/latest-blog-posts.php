<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_LatestBlogPosts extends SopranoTheme_VC_ShortcodeBase {

	/**
	 * Shortcode HTML output
	 *
	 * @param array $atts
	 * @param null|string $content
	 *
	 * @return string
	 */
	public function shortcode_render( $atts, $content = null ) {
		// parse attributes
		$atts = shortcode_atts(
			array(
				'posts_query'    => 'size:8|order_by:date|order:DESC|post_type:post',
				'layout_columns' => 'layout-4cols',
				'gutters_size'   => 'regular-gutters',
				'el_class'       => '',
				'css'            => '',
			),
			$atts
		);

		$atts['el_class'] .= SopranoTheme_VC_ShortcodeHelpers::custom_css_class( $atts['css'], ' ' );
		$atts['el_class'] .= trim( join( ' ', array( $atts['layout_columns'], $atts['gutters_size'] ) ) );

		if ( function_exists( 'vc_build_loop_query' ) ) {
			$atts['posts_query'] = vc_build_loop_query( $atts['posts_query'], true );
			$posts_query_args = $atts['posts_query'][0];
			$posts_query_args['ignore_sticky_posts'] = true;
			$atts['posts_query'] = new WP_Query($posts_query_args);
		} else {
			$atts['posts_query'] = new WP_Query();
		}

		return $this->render_template( 'latest-blog-posts', $atts );
	}


	/**
	 * Map shortcode in VC
	 */
	public function vc_map_shortcode() {
		// define shortcode params
		$sc_params = array(
			array(
				'type'        => 'loop',
				'heading'     => esc_html__( 'Posts query', 'soprano-ecommerce' ),
				'param_name'  => 'posts_query',
				'description' => esc_html__( 'Build custom query to display posts in this widget.', 'soprano-ecommerce' ),
				'settings'    => array(
					'post_type' => array( 'value' => 'post', 'locked' => 'true', 'hidden' => 'true' ),
					'size'      => array( 'value' => 8 ),
					'order_by'  => array( 'value' => 'date' ),
					'order'     => array( 'value' => 'DESC' )
				)
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Columns count', 'soprano-ecommerce' ),
				'description' => esc_html__( 'Select layout base columns count.', 'soprano-ecommerce' ),
				'param_name'  => 'layout_columns',
				'admin_label' => true,
				'value'       => array(
					esc_html__( '4 columns', 'soprano-ecommerce' ) => 'layout-4cols',
					esc_html__( '3 columns', 'soprano-ecommerce' ) => 'layout-3cols',
					esc_html__( '2 columns', 'soprano-ecommerce' ) => 'layout-2cols',
				)
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Gutter size', 'soprano-ecommerce' ),
				'description' => esc_html__( 'How many space should be present between sibling elements.', 'soprano-ecommerce' ),
				'param_name'  => 'gutters_size',
				'admin_label' => true,
				'value'       => array(
					esc_html__( 'Regular gutter', 'soprano-ecommerce' ) => 'regular-gutters',
					esc_html__( 'Small gutter', 'soprano-ecommerce' )   => 'small-gutters',
					esc_html__( 'No gutter', 'soprano-ecommerce' )      => 'no-gutters'
				)
			),

			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'soprano-ecommerce' ),
				'param_name'  => 'el_class',
				'value'       => '',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'soprano-ecommerce' )
			),

			array(
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'CSS box', 'soprano-ecommerce' ),
				'param_name' => 'css',
				'group'      => esc_html__( 'Design Options', 'soprano-ecommerce' )
			),
		);

		// now pass it all to visual composer
		vc_map( array(
			'name'     => esc_html__( 'Latest Blog Posts', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'params'   => $sc_params,
			'add_sequenced_animations' => true
		) );
	}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_LatestBlogPosts();