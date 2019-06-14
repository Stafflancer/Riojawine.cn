<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_Progress extends SopranoTheme_VC_ShortcodeBase {

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
				'value'    => '85%',
				'title'    => 'WordPress',
				'el_class' => '',
				'css'      => '',
			),
			$atts
		);

		$atts['el_class'] .= SopranoTheme_VC_ShortcodeHelpers::custom_css_class( $atts['css'], ' ' );

		return $this->render_template( 'progress-bar', $atts );
	}


	/**
	 * Map shortcode in VC
	*/
	public function vc_map_shortcode() {
		// define shortcode params
		$sc_params = array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Value', 'soprano-ecommerce' ),
				'param_name'  => 'value',
				'value'       => '85%',
				'description' => esc_html__( 'From 1 to 100, in %.', 'soprano-ecommerce' ),
				'admin_label' => true
			),

			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Title', 'soprano-ecommerce' ),
				'param_name'  => 'title',
				'value'       => 'WordPress',
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
			'name'     => esc_html__( 'Progress Bar', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'params'   => $sc_params,
		) );
	}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_Progress();