<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_Title extends SopranoTheme_VC_ShortcodeBase {

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
				'title'        => 'About Our Company',
				'sub_title'    => 'short story',
				'line'         => '',
				'el_class'     => '',
				'css'          => '',
			),
			$atts
		);

		// adding checkbox with line 
		if ( $atts['line'] === 'yes' ) {
			$atts['el_class'] .= ' line';
		}

		// restore shortcode definitions from vc
		$atts['title'] = str_replace(
			array( '`{`', '`}`', '``', ),
			array( '[', ']', '"', ),
			$atts['title']
		);

		return $this->render_template( 'title', $atts );
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
				'value'      => 'About Our Company',
				'admin_label' => true
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Sub Title', 'soprano-ecommerce' ),
				'param_name' => 'sub_title',
				'value'      => 'short story',
				'admin_label' => true
			),

			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Line', 'soprano-ecommerce' ),
				'param_name' => 'line',
				'value'      => array(
					esc_html__( 'Enable', 'soprano-ecommerce' ) => 'yes'
				),
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
			'name'     => esc_html__( 'Promo Title', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'params'   => $sc_params,
		) );
	}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_Title();