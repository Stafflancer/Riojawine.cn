<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_CountdownTimer extends SopranoTheme_VC_ShortcodeBase {

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
				'final_date'   => '',
				'el_class'     => '',
				'css'          => '',
			),
			$atts
		);

		$atts['el_class'] .= SopranoTheme_VC_ShortcodeHelpers::custom_css_class( $atts['css'], ' ' );
		$atts['el_class'] .= ' ' . $atts['color_scheme'];

		return $this->render_template( 'countdown-timer', $atts );
	}

	/**
	 * Map shortcode in VC
	 */
	public function vc_map_shortcode() {
		// define shortcode params
		$sc_params = array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Final date', 'soprano-ecommerce' ),
				'param_name'  => 'final_date',
				'admin_label' => true,
				'description' => wp_kses_post( __( 'Possible formats: <code>YYYY/MM/DD</code>, <code>YYY/MM/DD hh:mm:ss</code>', 'soprano-ecommerce' ) )
			),
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
			'name'     => esc_html__( 'Countdown Timer', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'params'   => $sc_params,
		) );
	}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_CountdownTimer();