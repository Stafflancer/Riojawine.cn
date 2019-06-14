<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_Text extends SopranoTheme_VC_ShortcodeBase {

	/**
	 * Shortcode HTML output
	 *
	 * @param array       $atts
	 * @param null|string $content
	 *
	 * @return string
	 */
	public function shortcode_render( $atts, $content = null ) {
		// parse attributes
		$atts = shortcode_atts(
			array(
				'text_p'       => '',
				'signature'    => 'PuzzleThemes Inc.',
				'font_family'  => 'primary-font',
				'font_size'    => '',
				'line_height'  => '',
				'custom_color' => '',
				'el_class'     => '',
				'css'          => '',
			),
			$atts
		);

		$atts['el_class'] .= SopranoTheme_VC_ShortcodeHelpers::custom_css_class( $atts['css'], ' ' );
		$atts['el_class'] .= ' ' . $atts['font_family'];

		// generate CSS
		$atts['custom_css'] = '';
		$css_string         = array(
			'font-size'   => $atts['font_size'],
			'line-height' => $atts['line_height'],
			'color'       => $atts['custom_color']
		);
		foreach ( $css_string as $prop => $value ) {
			if ( ! $value ) {
				continue;
			}
			$atts['custom_css'] .= $prop . ':' . esc_attr( $value ) . ';';
		}

		// back-compat for text_p param name
		if ( trim( $content ) ) {
			$atts['text_p'] = $content;
		}

		// restore shortcode definitions from vc
		$atts['text_p'] = str_replace(
			array( '`{`', '`}`', '``', ),
			array( '[', ']', '"', ),
			$atts['text_p']
		);

		return $this->render_template( 'text', $atts );
	}


	/**
	 * Map shortcode in VC
	 */
	public function vc_map_shortcode() {
		// define shortcode params
		$sc_params = array(
			array( // param name "text_p" is deprecated and will be removed soon
				'type'        => 'hidden_textfield',
				'param_name'  => 'text_p'
			),
			array(
				'type'        => 'textarea_html',
				'heading'     => esc_html__( 'Text', 'soprano-ecommerce' ),
				'param_name'  => 'content',
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Signature', 'soprano-ecommerce' ),
				'param_name'  => 'signature',
				'value'       => 'PuzzleThemes Inc.',
				'admin_label' => true
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Choose font', 'soprano-ecommerce' ),
				'param_name'  => 'font_family',
				'description' => esc_html__( 'This options is synchronised with theme options.', 'soprano-ecommerce' ),
				'group'       => esc_html__( 'Typography', 'soprano-ecommerce' ),
				'value'       => array(
					esc_html__( 'Primary font', 'soprano-ecommerce' )  => 'primary-font',
					esc_html__( 'Headings font', 'soprano-ecommerce' ) => 'headings-font',
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Font size', 'soprano-ecommerce' ),
				'param_name'  => 'font_size',
				'value'       => '',
				'description' => esc_html__( 'Leave empty to use default.', 'soprano-ecommerce' ),
				'group'       => esc_html__( 'Typography', 'soprano-ecommerce' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Line-height', 'soprano-ecommerce' ),
				'param_name'  => 'line_height',
				'value'       => '',
				'description' => esc_html__( 'Leave empty to use default.', 'soprano-ecommerce' ),
				'group'       => esc_html__( 'Typography', 'soprano-ecommerce' )
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Text Color', 'soprano-ecommerce' ),
				'param_name'  => 'custom_color',
				'description' => esc_html__( 'Select custom text color for text.', 'soprano-ecommerce' ),
				'group'       => esc_html__( 'Typography', 'soprano-ecommerce' )
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
			'name'     => esc_html__( 'Plain Text', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'params'   => $sc_params,
		) );
	}
}

// the file should always return shortcode instance
return new SopranoTheme_VC_Text();