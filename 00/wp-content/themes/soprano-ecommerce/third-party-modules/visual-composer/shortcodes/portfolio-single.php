<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_Portfolio_Single extends SopranoTheme_VC_ShortcodeBase {

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
				'title'     => 'Sobbing wow fraternally',
				'text'      => '',
				'date'      => 'Published: 08/27/2017',
				'service'   => 'Service: Marketing',
				'client'    => 'Client: Yandex',
				'wide'      => '',
				'el_class'  => '',
				'css'       => '',
			),
			$atts
		);

		$atts['el_class'] .= SopranoTheme_VC_ShortcodeHelpers::custom_css_class( $atts['css'], ' ' );

		// adding checkbox with feature table 
		if ( $atts['wide'] === 'yes' ) {
			$atts['el_class'] .= ' unlist';
		}

		// back-compat for text param name
		if ( trim( $content ) ) {
			$atts['text'] = $content;
		}

		return $this->render_template( 'portfolio-single', $atts );
	}



	/**
	 * Map shortcode in VC
	*/
	public function vc_map_shortcode() {
		// define shortcode params
		$sc_params = array(
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Title', 'soprano-ecommerce' ),
				'param_name' => 'title',
				'value'      => 'Sobbing wow fraternally',
				'admin_label' => true
			),

			array( // param name "text" is deprecated and will be removed soon
			       'type'       => 'hidden_textfield',
			       'param_name' => 'text'
			),
			array(
				'type'        => 'textarea_html',
				'heading'     => esc_html__( 'Text', 'soprano-ecommerce' ),
				'param_name'  => 'content',
				'admin_label' => true
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Date', 'soprano-ecommerce' ),
				'param_name' => 'date',
				'value'      => 'Published: 08/27/2017',
				'admin_label' => true
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Service (Tags)', 'soprano-ecommerce' ),
				'param_name' => 'service',
				'value'      => 'Service: Marketing',
				'admin_label' => true
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Client', 'soprano-ecommerce' ),
				'param_name' => 'client',
				'value'      => 'Client: Yandex',
				'admin_label' => true
			),

			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'One Line', 'soprano-ecommerce' ),
				'param_name' => 'wide',
				'value'      => array(
					esc_html__( 'Enable', 'soprano-ecommerce' ) => 'yes'
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
			'name'     => esc_html__( 'Portfolio Single', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'params'   => $sc_params,
		) );
	}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_Portfolio_Single();