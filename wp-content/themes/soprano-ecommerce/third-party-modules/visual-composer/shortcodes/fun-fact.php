<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_Fun_Fact extends SopranoTheme_VC_ShortcodeBase {

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
				'color_scheme' => 'color-light',
				'title'        => 'Sales Per Day',
				'number'       => '153',
				'min'          => '0',
				'delay'        => '5',
				'increment'    => '2',
				'el_class'     => '',
				'css'          => '',
			),
			$atts
		);

		$atts['el_class'] .= SopranoTheme_VC_ShortcodeHelpers::custom_css_class( $atts['css'], ' ' );
		$atts['el_class'] .= ' ' . $atts['color_scheme'];

		return $this->render_template( 'fun-fact', $atts );
	}

	/**
	 * Map shortcode in VC
	*/
	public function vc_map_shortcode() {
		// define shortcode params
		$sc_params = array(
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Color scheme', 'soprano-ecommerce' ),
				'param_name'  => 'color_scheme',
				'value'       => array(
					esc_html__( 'Light', 'soprano-ecommerce' ) => 'color-light',
					esc_html__( 'Dark', 'soprano-ecommerce' )  => 'color-dark',
				),
				'description' => esc_html__( 'Select color scheme for this element.', 'soprano-ecommerce' )
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Title', 'soprano-ecommerce' ),
				'param_name' => 'title',
				'value'      => 'Sales Per Day',
				'admin_label' => true

			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Number', 'soprano-ecommerce' ),
				'param_name' => 'number',
				'value'      => '153'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Min', 'soprano-ecommerce' ),
				'param_name' => 'min',
				'value'      => '0'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Delay', 'soprano-ecommerce' ),
				'param_name' => 'delay',
				'value'      => '5'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Increment', 'soprano-ecommerce' ),
				'param_name' => 'increment',
				'value'      => '2'
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
			'name'     => esc_html__( 'Fun Fact', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'params'   => $sc_params,
		) );
	}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_Fun_Fact();