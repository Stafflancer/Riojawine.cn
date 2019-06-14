<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_SlickSlider extends SopranoTheme_VC_ShortcodeBase {

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
				'slides'             => '',
				'slick_options'      => 'autoplay: true' . "\n" . 'autoplaySpeed: 3500' . "\n" . 'dots: true' . "\n" . 'infinite: true' . "\n" . 'speed: 750' . "\n" . 'adaptiveHeight: true' . "\n" . 'arrows: false',
				'responsive_options' => '',
				'el_class'           => '',
				'css'                => ''
			),
			$atts
		);

		// add custom css class to array
		$atts['el_class'] .= SopranoTheme_VC_ShortcodeHelpers::custom_css_class( $atts['css'], ' ' );

		// parse array of slides
		$atts['slides'] = SopranoTheme_VC_ShortcodeHelpers::param_group_parse_atts( $atts['slides'] );
		foreach ( $atts['slides'] as &$slide ) {
			$slide = shortcode_atts(
				array(
					'caption' => '',
					'image'   => '',
				),
				$slide
			);
		}

		// parse basic options first
		$atts['slick_options'] = $this->parse_options( $atts['slick_options'] );

		// then parse responsive options
		if ( trim( $atts['responsive_options'] ) ) {
			$atts['slick_options']['responsive'] = array();
			$responsive_options = SopranoTheme_VC_ShortcodeHelpers::param_group_parse_atts( $atts['responsive_options'] );

			foreach ( $responsive_options as $r_option ) {
				$r_option = shortcode_atts(
					array(
						'breakpoint' => '',
						'options'    => '',
					),
					$r_option
				);

				if ( ! is_numeric( $r_option['breakpoint'] ) || $r_option['breakpoint'] < 0 ) {
					continue;
				}

				$atts['slick_options']['responsive'][] = array(
					'breakpoint' => intval( $r_option['breakpoint'] ),
					'settings'   => $this->parse_options( $r_option['options'] )
				);
			}

			if ( sizeof( $atts['slick_options']['responsive'] ) <= 0 ) {
				unset ( $atts['slick_options']['responsive'] );
			}
		}

		// render template and return it
		return $this->render_template( 'slick-slider', $atts );
	}


	/**
	 * Map shortcode in VC
	 */
	public function vc_map_shortcode() {
		// define shortcode params
		$sc_params = array(
			array(
				'heading'    => esc_html__( 'Slides', 'soprano-ecommerce' ),
				'type'       => 'param_group',
				'param_name' => 'slides',
				'params'     => array(
					array(
						'type'        => 'attach_image',
						'heading'     => esc_html__( 'Image', 'soprano-ecommerce' ),
						'param_name'  => 'image',
						'value'       => '',
						'description' => esc_html__( 'Upload image for this slide. Recommended size is at least 1280x800px', 'soprano-ecommerce' ),
						'admin_label' => true
					),

					array(
						'type'        => 'textarea',
						'heading'     => esc_html__( 'Caption', 'soprano-ecommerce' ),
						'param_name'  => 'caption',
						'value'       => '',
						'description' => esc_html__( 'Basic HTML and shortcodes is allowed. Can be empty.', 'soprano-ecommerce' ),
						'admin_label' => true
					)
				)
			),
			array(
				'type'        => 'textarea',
				'heading'     => esc_html__( 'Custom options', 'soprano-ecommerce' ),
				'param_name'  => 'slick_options',
				'value'       => 'autoplay: true' . "\n" . 'autoplaySpeed: 3500' . "\n" . 'dots: true' . "\n" . 'infinite: true' . "\n" . 'speed: 750' . "\n" . 'adaptiveHeight: true' . "\n" . 'arrows: false',
				'description' => wp_kses_post( __( '<b>Format:</b> option: value (one per line). <a href="http://kenwheeler.github.io/slick/#settings" target="_blank">Complete list of available options.</a>',
					'soprano-ecommerce' ) ),
			),
			array(
				'heading'    => esc_html__( 'Responsive options', 'soprano-ecommerce' ),
				'type'       => 'param_group',
				'group'      => esc_html__( 'Responsive Options', 'soprano-ecommerce' ),
				'param_name' => 'responsive_options',
				'params'     => array(
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Breakpoint', 'soprano-ecommerce' ),
						'param_name'  => 'breakpoint',
						'value'       => '',
						'description' => esc_html__( 'Integer value.', 'soprano-ecommerce' ),
						'admin_label' => true
					),

					array(
						'type'        => 'textarea',
						'heading'     => esc_html__( 'Custom options', 'soprano-ecommerce' ),
						'param_name'  => 'options',
						'value'       => '',
						'description' => esc_html__( 'Here you can define custom options for only this breakpoint.', 'soprano-ecommerce' ),
					),
				)
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'soprano-ecommerce' ),
				'param_name'  => 'el_class',
				'value'       => '',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'soprano-ecommerce' )
			),
		);

		// now pass it all to visual composer
		vc_map( array(
			'name'     => esc_html__( 'Slick Slider', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'params'   => $sc_params,
		) );
	}


	/**
	 * Parse options list and convert it to pure php array
	 *
	 * @param $options
	 *
	 * @return array
	 */
	private function parse_options( $options ) {
		$options_out = array();

		foreach ( explode( PHP_EOL, strip_tags( $options ) ) as $line ) {
			list( $property, $value ) = array_map( 'trim', explode( ':', $line, 2 ) );
			$value = rtrim( $value, ',;.' );

			if ( strtolower( $value ) === 'true' || strtolower( $value ) === 'false' ) {
				$value = (bool) ( strtolower( $value ) === 'true' );

			} else if ( preg_match( '/^[0-9]+$/', $value ) ) {
				$value = intval( $value );

			} else {
				$value = '"' . esc_attr( $value ) . '"';
			}

			$options_out[ $property ] = $value;
		}

		return $options_out;
	}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_SlickSlider();