<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */

class SopranoTheme_VC_Intro_Image_Icon extends SopranoTheme_VC_ShortcodeBase {

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
				'image_icon' => 'image',
				'image'      => '',
				'icon'       => 'icon-ion-ios-speedometer-outline',
				'el_class'   => '',
				'css'        => '',
			),
			$atts
		);

		$atts['el_class'] .= SopranoTheme_VC_ShortcodeHelpers::custom_css_class( $atts['css'], ' ' );

		return $this->render_template( 'intro-image', $atts );
	}

	/**
	 * Map shortcode in VC
	*/
	public function vc_map_shortcode() {
		// generate proper link to icons page
		$icons_page = get_theme_file_uri('public/icon-font/demo.html');

		// define shortcode params
		$sc_params = array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Type', 'soprano-ecommerce' ),
				'param_name' => 'image_icon',
				'value'      => array(
					esc_html__( 'Image', 'soprano-ecommerce' ) => 'image',
					esc_html__( 'Icon', 'soprano-ecommerce' ) => 'icon',
				),
			),
			array(
				'type'       => 'attach_image',
				'heading'    => esc_html__( 'Logo', 'soprano-ecommerce' ),
				'param_name' => 'image',
				'value'      => '',
				'dependency' => array(
					'element' => 'image_icon',
					'value'   => 'image',
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Icon', 'soprano-ecommerce' ),
				'param_name'  => 'icon',
				'value'       => 'icon-ion-ios-speedometer-outline',
				'description' => wp_kses_post( sprintf( __( 'You can pick up and paste icons <a href="%s" target="_blank">here</a>.', 'soprano-ecommerce' ),  $icons_page ) ),
				'dependency'  => array(
					'element' => 'image_icon',
					'value'   => 'icon',
				),
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
			'name'     => esc_html__( 'Intro Image/Icon', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'params'   => $sc_params,
		) );
	}

}
// the file should always return shortcode instance
return new SopranoTheme_VC_Intro_Image_Icon();