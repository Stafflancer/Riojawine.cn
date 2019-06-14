<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_Button extends SopranoTheme_VC_ShortcodeBase {

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
				'link'               => '',
				'style'              => 'btn-primary',
				'size'               => '',
				'align'              => 'align_center',
				'el_class'           => '',
				'css'                => '',
			),
			$atts
		);

		// define button attributes
		$button_atts = array_merge(
			SopranoTheme_VC_ShortcodeHelpers::build_link( $atts['link'] ),
			array( 'class' => 'btn ' . $atts['style'] . ' ' . $atts['size'] )
		);

		// fir VC's ugly array index names
		$button_atts['href'] = $button_atts['url'];
		unset( $button_atts['url'] );

		// define button container attributes
		$container_atts = array(
			'class' => join(
				' ',
				array(
					'sp-btn-container',
					$atts['el_class'],
					$atts['align'],
					SopranoTheme_VC_ShortcodeHelpers::custom_css_class( $atts['css'] )
				)
			)
		);

		// build button markup and then container markup
		$button_markup = sp_theme_build_tag( 'a', $button_atts, $button_atts['title'] );
		return sp_theme_build_tag('div', $container_atts, $button_markup);
	}


	/**
	 * Map shortcode in VC
	 */
	public function vc_map_shortcode() {
		// define shortcode params
		$sc_params = array(
			array(
				'type'        => 'vc_link',
				'heading'     => esc_html__( 'Link', 'soprano-ecommerce' ),
				'param_name'  => 'link',
				'admin_label' => true
			),
			
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Style', 'soprano-ecommerce' ),
				'param_name'  => 'style',
				'value' => array(
					esc_html__( 'Primary color', 'soprano-ecommerce' )             => 'btn-primary',
					esc_html__( 'Green color', 'soprano-ecommerce' )               => 'btn-success',
					esc_html__( 'Blue color', 'soprano-ecommerce' )                => 'btn-info',
					esc_html__( 'Orange color', 'soprano-ecommerce' )              => 'btn-warning',
					esc_html__( 'Red color', 'soprano-ecommerce' )                 => 'btn-danger',
					esc_html__( 'White color', 'soprano-ecommerce' )               => 'btn-white',
					esc_html__( 'Simple (without backdrop)', 'soprano-ecommerce' ) => 'btn-simple'
				),
				'description' => esc_html__( 'Select button size.', 'soprano-ecommerce' )
			),
			
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Size', 'soprano-ecommerce' ),
				'param_name'  => 'size',
				'value' => array(
					esc_html__( 'Default', 'soprano-ecommerce' )     => '',
					esc_html__( 'Large', 'soprano-ecommerce' )       => 'btn-lg',
					esc_html__( 'Small', 'soprano-ecommerce' )       => 'btn-sm',
				),
				'description' => esc_html__( 'Select button size.', 'soprano-ecommerce' )
			),
			
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Alignment', 'soprano-ecommerce' ),
				'param_name'  => 'align',
				'value'       => array(
					esc_html__( 'Center', 'soprano-ecommerce' ) => 'align_center',
					esc_html__( 'Left', 'soprano-ecommerce' )   => 'align_left',
					esc_html__( 'Right', 'soprano-ecommerce' )  => 'align_right'
				),
				'description' => esc_html__( 'Select button alignment.', 'soprano-ecommerce' )
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
			'name'     => esc_html__( 'Button', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'params'   => $sc_params,
		) );
	}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_Button();