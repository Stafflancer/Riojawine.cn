<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_Portfolio extends SopranoTheme_VC_ShortcodeBase {

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
				'items'          => '',
				'layout_columns' => 'layout-4cols',
				'gutters_size'   => '',
				'filters_layout' => 'hide-filter',
				'el_class'       => '',
				'css'            => '',
			),
			$atts
		);

		// add generated css classes to el_class
		$atts['el_class'] .= SopranoTheme_VC_ShortcodeHelpers::custom_css_class( $atts['css'], ' ' );

		// generate markup for each slide
		$atts['items'] = SopranoTheme_VC_ShortcodeHelpers::param_group_parse_atts( $atts['items'] );
		$p_items = array();
		foreach ( $atts['items'] as $portfolio_item ) {
			$p_items[] = shortcode_atts(
				array(
					'id'     => '',
					'layout' => ''
				),
				$portfolio_item
			);
		}
		$atts['items'] = $p_items;

		// generate array of portfolio tag taxonomy instances
		$atts['items_tags'] = $this->parse_portfolio_tags( $atts['items'] );

		return $this->render_template( 'portfolio', $atts );
	}


	/**
	 * Generates array containing all taxonomies from specified portfolio items
	 *
	 * @param $items
	 *
	 * @return array
	 */
	private function parse_portfolio_tags( $items ) {
		$item_ids = wp_list_pluck( $items, 'id' );

		return wp_get_object_terms( $item_ids, 'sp-portfolio-tag' );
	}


	/**
	 * Generates string of item tags to use in `data-groups` attribute
	 *
	 * @param $post_id
	 *
	 * @return string
	 */
	public function get_item_tags_as_attr( $post_id ) {
		$item_tags = get_the_terms( $post_id, 'sp-portfolio-tag' );
		if ( ! is_array( $item_tags ) ) {
			return '';
		}

		$item_tags = wp_list_pluck( $item_tags, 'term_id' );
		foreach ( $item_tags as &$item_tag ) {
			$item_tag = sprintf( 'tag-%d', $item_tag );
		}

		return implode( ',', $item_tags );
	}


	/**
	 * Map shortcode in VC
	 */
	public function vc_map_shortcode() {
		// define shortcode params
		$sc_params = array(
			array(
				'heading'    => esc_html__( 'Portfolio items', 'soprano-ecommerce' ),
				'type'       => 'param_group',
				'param_name' => 'items',
				'params'     => array(
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Item ID', 'soprano-ecommerce' ),
						'param_name'  => 'id',
						'value'       => '',
						'description' => esc_html__( 'ID of item that should be displayed.', 'soprano-ecommerce' ),
						'admin_label' => true
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__( 'Item layout', 'soprano-ecommerce' ),
						'param_name'  => 'layout',
						'admin_label' => true,
						'value'       => array(
							esc_html__( 'Regular', 'soprano-ecommerce' )          => '',
							esc_html__( '2x wide', 'soprano-ecommerce' )          => 'wide-2x',
							esc_html__( '2x tall', 'soprano-ecommerce' )          => 'tall-2x',
							esc_html__( '2x wide, 2x tall', 'soprano-ecommerce' ) => 'wide-2x tall-2x',
						),
					)
				)
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Columns count', 'soprano-ecommerce' ),
				'description' => esc_html__( 'Select portfolio layout base columns count.', 'soprano-ecommerce' ),
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
					esc_html__( 'Regular gutter', 'soprano-ecommerce' ) => '',
					esc_html__( 'Small gutter', 'soprano-ecommerce' )   => 'small-gutters',
					esc_html__( 'No gutter', 'soprano-ecommerce' )      => 'no-gutters'
				)
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Filters layout', 'soprano-ecommerce' ),
				'description' => esc_html__( 'Here you can control filters block appearance.', 'soprano-ecommerce' ),
				'param_name'  => 'filters_layout',
				'admin_label' => true,
				'value'       => array(
					esc_html__( 'No layout (hide filter)', 'soprano-ecommerce' ) => 'hide-filter',
					esc_html__( 'Buttons', 'soprano-ecommerce' )                 => 'button-filters',
					esc_html__( 'Seamless', 'soprano-ecommerce' )                => 'seamless-filters',
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
			'name'     => esc_html__( 'Portfolio', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'params'   => $sc_params,
		) );
	}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_Portfolio();