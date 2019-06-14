<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_Team_Member extends SopranoTheme_VC_ShortcodeBase {

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
				'title'     => 'Billy Porter',
				'type'      => 'CEO',
				'image'     => '',
				'facebook'  => '#',
				'twitter'   => '#',
				'instagram' => '#',
				'linkedin'  => '#',
				'dribbble'  => '',
				'pinterest' => '',
				'google'    => '',
				'youtube'   => '',
				'el_class'  => '',
				'css'       => '',
			),
			$atts
		);

		$atts['el_class'] .= SopranoTheme_VC_ShortcodeHelpers::custom_css_class( $atts['css'], ' ' );

		return $this->render_template( 'team-member', $atts );
	}


	/**
	 * Map shortcode in VC
	*/
	public function vc_map_shortcode() {
		// define shortcode params
		$sc_params = array(
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Text', 'soprano-ecommerce' ),
				'param_name' => 'title',
				'value'      => 'Billy Porter',
				'admin_label' => true
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Type', 'soprano-ecommerce' ),
				'param_name' => 'type',
				'value'      => 'CEO',
				'admin_label' => true
			),

			array(
				'type'       => 'attach_image',
				'heading'    => esc_html__( 'Image', 'soprano-ecommerce' ),
				'param_name' => 'image',
				'value'      => '',
			),


			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Facebook', 'soprano-ecommerce' ),
				'param_name' => 'facebook',
				'value'      => '#',
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Twitter', 'soprano-ecommerce' ),
				'param_name' => 'twitter',
				'value'      => '#',
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Instagram', 'soprano-ecommerce' ),
				'param_name' => 'instagram',
				'value'      => '#',
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'LinkedIn', 'soprano-ecommerce' ),
				'param_name' => 'linkedin',
				'value'      => '#',
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Dribbble', 'soprano-ecommerce' ),
				'param_name' => 'dribbble',
				'value'      => '',
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Pinterest', 'soprano-ecommerce' ),
				'param_name' => 'pinterest',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Google Plus', 'soprano-ecommerce' ),
				'param_name' => 'google',
				'value'      => '',
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'YouTube', 'soprano-ecommerce' ),
				'param_name' => 'youtube',
				'value'      => '',
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
			'name'     => esc_html__( 'Team Member', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'params'   => $sc_params,
		) );
	}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_Team_Member();