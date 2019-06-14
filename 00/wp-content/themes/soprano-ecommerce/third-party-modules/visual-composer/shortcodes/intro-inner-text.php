<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_IntroInnerText extends SopranoTheme_VC_ShortcodeBase {

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
				'text_size'          => 'intro-regular-text',
				'element_type'       => 'div',
				'el_class'           => '',
				'css'                => '',
			),
			$atts
		);

		// process VC custom param values
		$atts['el_class'] .= ' ' . $atts['text_size'];
		$atts['el_class'] .= SopranoTheme_VC_ShortcodeHelpers::custom_css_class( $atts['css'], ' ' );

		// build element attributes
		$elem_atts = array( 'class' => $atts['el_class'] );

		return sp_theme_build_tag( $atts['element_type'], $elem_atts, do_shortcode( $content ) );
	}


	/**
	 * Map shortcode in VC
	 */
	public function vc_map_shortcode() {
		// define shortcode params
		$sc_params = array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Text size', 'soprano-ecommerce' ),
				'param_name' => 'text_size',
				'value'      => array(
					esc_html__( 'Regular paragraph', 'soprano-ecommerce' ) => 'intro-regular-text',
					esc_html__( 'Heading 1', 'soprano-ecommerce' )         => 'intro-title intro-title-1',
					esc_html__( 'Heading 2', 'soprano-ecommerce' )         => 'intro-title intro-title-2',
					esc_html__( 'Heading 3', 'soprano-ecommerce' )         => 'intro-title intro-title-3',
					esc_html__( 'Heading 4', 'soprano-ecommerce' )         => 'intro-title intro-title-4',
					esc_html__( 'Heading 5', 'soprano-ecommerce' )         => 'intro-title intro-title-5',
					esc_html__( 'Heading 6', 'soprano-ecommerce' )         => 'intro-title intro-title-6',
				),
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Element type', 'soprano-ecommerce' ),
				'param_name'  => 'element_type',
				'value'       => array(
					esc_html__( 'DIV', 'soprano-ecommerce' ) => 'div',
					esc_html__( 'P', 'soprano-ecommerce' )   => 'p',
					esc_html__( 'H1', 'soprano-ecommerce' )  => 'h1',
					esc_html__( 'H2', 'soprano-ecommerce' )  => 'h2',
					esc_html__( 'H3', 'soprano-ecommerce' )  => 'h3',
					esc_html__( 'H4', 'soprano-ecommerce' )  => 'h4',
					esc_html__( 'H5', 'soprano-ecommerce' )  => 'h5',
					esc_html__( 'H6', 'soprano-ecommerce' )  => 'h6',
				),
				'description' => esc_html__( 'For better SEO you can define which type of element should be used for this title.', 'soprano-ecommerce' ),
			),

			array(
				'type'        => 'textarea_html',
				'heading'     => esc_html__( 'Text', 'soprano-ecommerce' ),
				'param_name'  => 'content',
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
			)
		);

		// now pass it all to visual composer
		vc_map( array(
			'name'     => esc_html__( 'Intro Inner Text', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'as_child' => array( 'only' => 'soprano_theme_intro_container' ),
			'params'   => $sc_params,
		) );
	}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_IntroInnerText();