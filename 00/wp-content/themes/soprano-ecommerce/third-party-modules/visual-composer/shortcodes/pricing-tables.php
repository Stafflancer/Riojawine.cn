<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_Pricing_Tables extends SopranoTheme_VC_ShortcodeBase {

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
				'name'              => 'Basic',
				'currency'          => '$',
				'value'             => '0',
				'period'            => 'mth',
				'services'          => '',
				'button'            => '',
				'button_text_one'   => 'Get Started',
				'button_link_one'   => '#',
				'button_text_two'   => 'Try Trial',
				'button_link_two'   => '#',
				'button_text_three' => 'Get Started',
				'button_link_three' => '#',
				'feature'           => '',
				'el_class'          => '',
				'css'               => '',
			),
			$atts
		);

		$atts['el_class'] .= SopranoTheme_VC_ShortcodeHelpers::custom_css_class( $atts['css'], ' ' );

		// parse array of slides
		$atts['services'] = SopranoTheme_VC_ShortcodeHelpers::param_group_parse_atts( $atts['services'] );
		foreach ( $atts['services'] as &$service ) {
			$service = shortcode_atts(
				array( 'text' => '' ),
				$service
			);
		}

		// adding checkbox with feature table 
		if ( $atts['feature'] === 'yes' ) {
			$atts['el_class'] .= ' featured';
		}

		return $this->render_template( 'pricing-tables', $atts );
	}




	/**
	 * Map shortcode in VC
	*/
	public function vc_map_shortcode() {
		// define shortcode params
		$sc_params = array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Name', 'soprano-ecommerce' ),
				'param_name'  => 'name',
				'value'       => 'Basic',
				'admin_label' => true
			),

			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Price', 'soprano-ecommerce' ),
				'param_name'  => 'value',
				'value'       => '0',
				'admin_label' => true
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Currency', 'soprano-ecommerce' ),
				'param_name' => 'currency',
				'value'      => '$',
			),

			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Period', 'soprano-ecommerce' ),
				'param_name'  => 'period',
				'value'       => 'mth',
				'admin_label' => true
			),

			array(
				'heading'    => esc_html__( 'Services', 'soprano-ecommerce' ),
				'type'       => 'param_group',
				'param_name' => 'services',
				'params'     => array(
					array(
						'type'        => 'textarea',
						'heading'     => esc_html__( 'Text', 'soprano-ecommerce' ),
						'param_name'  => 'text',
						'value'       => 'Basic Support',
						'admin_label' => true
					),
				)
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Button Type', 'soprano-ecommerce' ),
				'param_name' => 'button',
				'value'      => array(
					esc_html__( 'Single', 'soprano-ecommerce' ) => 'single',
					esc_html__( 'Double', 'soprano-ecommerce' ) => 'double',
				),
			),

			array(
				'type'       => 'textfield',
				'heading'    => __( 'Button', 'soprano-ecommerce' ),
				'param_name' => 'button_text_one',
				'value'      => 'Get Started',
				'dependency' => array(
					'element' => 'button',
					'value'   => 'single',
				),
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Button Link', 'soprano-ecommerce' ),
				'param_name' => 'button_link_one',
				'value'      => '#',
				'dependency' => array(
					'element' => 'button',
					'value'   => 'single',
				),
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Button', 'soprano-ecommerce' ),
				'param_name' => 'button_text_two',
				'value'      => 'Get Started',
				'dependency' => array(
					'element' => 'button',
					'value'   => 'double',
				),
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Button Link', 'soprano-ecommerce' ),
				'param_name' => 'button_link_two',
				'value'      => '#',
				'dependency' => array(
					'element' => 'button',
					'value'   => 'double',
				),
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Button #2', 'soprano-ecommerce' ),
				'param_name' => 'button_text_three',
				'value'      => 'Try Trial',
				'dependency' => array(
					'element' => 'button',
					'value'   => 'double',
				),
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Button Link #2', 'soprano-ecommerce' ),
				'param_name' => 'button_link_three',
				'value'      => '#',
				'dependency' => array(
					'element' => 'button',
					'value'   => 'double',
				),
			),

			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Feature', 'soprano-ecommerce' ),
				'param_name'  => 'feature',
				'value'       => array(
					esc_html__( 'Enable', 'soprano-ecommerce' ) => 'yes'
				),
				'admin_label' => true
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
			'name'     => esc_html__( 'Pricing Tables', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'params'   => $sc_params,
		) );
	}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_Pricing_Tables();