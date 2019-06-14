<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_Faq extends SopranoTheme_VC_ShortcodeBase {

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
				'faqs'     => '',
				'open_tab' => '1',
				'el_class' => '',
				'css'      => '',
			),
			$atts
		);

		$atts['el_class'] .= SopranoTheme_VC_ShortcodeHelpers::custom_css_class( $atts['css'], ' ' );

		// parse array of slides
		$atts['faqs'] = SopranoTheme_VC_ShortcodeHelpers::param_group_parse_atts( $atts['faqs'] );
		foreach ( $atts['faqs'] as &$faq ) {
			$faq = shortcode_atts(
				array(
					'title'     => 'Question text',
					'text'      => 'Answer text'
				),
				$faq
			);
		}

		return $this->render_template( 'faq', $atts );
	}


	/**
	 * Map shortcode in VC
	*/
	public function vc_map_shortcode() {
		// define shortcode params
		$sc_params = array(
			array(
				'heading'    => esc_html__( 'Questions & Answers', 'soprano-ecommerce' ),
				'type'       => 'param_group',
				'param_name' => 'faqs',
				'params'     => array(
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__( 'Question', 'soprano-ecommerce' ),
						'param_name' => 'title',
						'value'      => 'Question text',
						'admin_label' => true
					),

					array(
						'type'       => 'textarea',
						'heading'    => esc_html__( 'Answer', 'soprano-ecommerce' ),
						'param_name' => 'text',
						'value'      => 'Answer text',
					)
				)
			),

			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Open tab', 'soprano-ecommerce' ),
				'param_name'  => 'open_tab',
				'value'       => '1',
				'description' => esc_html__( 'Which tab should be open by default - type number or leave empty to set all tabs closed.', 'soprano-ecommerce' )
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
			'name'     => esc_html__( 'F.A.Q.', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'params'   => $sc_params,
		) );
	}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_Faq();