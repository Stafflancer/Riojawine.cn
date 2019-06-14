<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_Mailchimp_Form extends SopranoTheme_VC_ShortcodeBase {

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
				'heading'      => 'Subscribe To Our Newsletter',
				'form_url'     => '',
				'opening_text' => '',
				'hide_image'   => '',
				'el_class'     => '',
				'css'          => '',
			),
			$atts
		);

		$atts['el_class'] .= SopranoTheme_VC_ShortcodeHelpers::custom_css_class( $atts['css'], ' ' );

		return $this->render_template( 'mailchimp-form', $atts );
	}

	/**
	 * Map shortcode in VC
	*/
	public function vc_map_shortcode() {
		// define shortcode params
		$sc_params = array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Form title', 'soprano-ecommerce' ),
				'param_name'  => 'heading',
				'value'       => 'Subscribe To Our Newsletter',
				'admin_label' => true
			),

			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Form URL', 'soprano-ecommerce' ),
				'param_name'  => 'form_url',
				'value'       => '',
				'description' => esc_html__( 'This should be something like http://xxxx.us9.list-manage.com/subscribe/post?u=1368c473b42d831e481262a9c&id=63bbf421ee', 'soprano-ecommerce' )
			),

			array(
				'type'       => 'textarea',
				'heading'    => esc_html__( 'Opening text', 'soprano-ecommerce' ),
				'param_name' => 'opening_text',
				'value'      => ''
			),

			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Hide image', 'soprano-ecommerce' ),
				'param_name'  => 'hide_image',
				'value'       => array(
					esc_html__( 'Enable', 'soprano-ecommerce' ) => 'yes'
				),
				'description' => esc_html__( 'This will hide Mailchimp logo below email input field.', 'soprano-ecommerce' )
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
			'name'     => esc_html__( 'Mailchimp Subscribe Form', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'params'   => $sc_params,
		) );
	}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_Mailchimp_Form();