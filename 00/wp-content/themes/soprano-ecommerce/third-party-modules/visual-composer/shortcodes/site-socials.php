<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_SiteSocials extends SopranoTheme_VC_ShortcodeBase {

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
				'color'    => '',
				'align'    => 'align_center',
				'el_class' => '',
				'css'      => '',
			),
			$atts
		);

		$atts['el_class'] .= SopranoTheme_VC_ShortcodeHelpers::custom_css_class( $atts['css'], ' ' );

		$atts['socials']  = sp_theme_site_socials( true );

		return $this->render_template( 'site-socials', $atts );
	}

	/**
	 * Map shortcode in VC
	*/
	public function vc_map_shortcode() {
		// define shortcode params
		$sc_params = array(
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Alignment', 'soprano-ecommerce' ),
				'param_name'  => 'align',
				'value'       => array(
					esc_html__( 'Center', 'soprano-ecommerce' ) => 'align_center',
					esc_html__( 'Left', 'soprano-ecommerce' )   => 'align_left',
					esc_html__( 'Right', 'soprano-ecommerce' )  => 'align_right'
				),
				'description' => esc_html__( 'Select icons alignment.', 'soprano-ecommerce' )
			),

			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Icons color', 'soprano-ecommerce' ),
				'param_name'  => 'color',
				'value'       => '',
				'description' => esc_html__( 'Here you can set the initial color of icons in this widget.', 'soprano-ecommerce' )
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
			'name'     => esc_html__( 'Site Socials', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'params'   => $sc_params,
		) );
	}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_SiteSocials();