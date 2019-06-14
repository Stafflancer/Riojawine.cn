<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_List extends SopranoTheme_VC_ShortcodeBase {

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
				'lists'      => '',
				'border'     => 'top',
				'el_class'   => '',
				'css'        => '',
			),
			$atts
		);

		$atts['el_class'] .= SopranoTheme_VC_ShortcodeHelpers::custom_css_class( $atts['css'], ' ' );

		if ( $atts['border'] === 'none' ) { $atts['el_class'] .= ' border-none'; }
		if ( $atts['border'] === 'top' ) { $atts['el_class'] .= ' border-top'; }
		if ( $atts['border'] === 'bottom' ) { $atts['el_class'] .= ' border-bottom'; }

		// parse array of slides
		$atts['lists'] = SopranoTheme_VC_ShortcodeHelpers::param_group_parse_atts( $atts['lists'] );
		foreach ( $atts['lists'] as &$list ) {
			$list = shortcode_atts(
				array(
					'title'     => 'Where Is My Purchase Code?',
					'link'      => '#'
				),
				$list
			);
		}
		return $this->render_template( 'list', $atts );
	}




	/**
	 * Map shortcode in VC
	*/
	public function vc_map_shortcode() {
		// define shortcode params
		$sc_params = array(
			array(
				'heading'    => esc_html__( 'Lists', 'soprano-ecommerce' ),
				'type'       => 'param_group',
				'param_name' => 'lists',
				'params'     => array(
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__( 'Title', 'soprano-ecommerce' ),
						'param_name' => 'title',
						'value'      => 'Where Is My Purchase Code?',
						'admin_label' => true
					),

					array(
						'type'       => 'textfield',
						'heading'    => esc_html__( 'Link', 'soprano-ecommerce' ),
						'param_name' => 'link',
						'value'      => '#',
					)
				)
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Border', 'soprano-ecommerce' ),
				'param_name' => 'border',
				'value'      => array(
					esc_html__( 'None', 'soprano-ecommerce' ) => 'none',
					esc_html__( 'Top', 'soprano-ecommerce' ) => 'top',
					esc_html__( 'Bottom', 'soprano-ecommerce' ) => 'bottom',
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
			'name'     => esc_html__( 'Lists', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'params'   => $sc_params,
		) );
	}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_List();