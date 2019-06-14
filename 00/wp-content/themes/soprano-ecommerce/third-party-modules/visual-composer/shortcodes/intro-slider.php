<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_IntroSlider extends SopranoTheme_VC_ShortcodeBase {

	/**
	 * Shortcode HTML output
	 *
	 * @param array $atts
	 * @param null  $content
	 *
	 * @return string
	 */
	public function shortcode_render( $atts, $content = null ) {
		// parse attributes
		$atts = shortcode_atts(
			array(
				'slick_options'     => '',
				'slider_height'     => '475px',
				'ken_burns'         => '',
				'slides'            => '',
				'el_class'          => '',
			),
			$atts
		);

		// firstly, generate attributes for container
		if ( $atts['ken_burns'] === 'yes' ) {
			$atts['el_class'] .= ' kenburns';
		}
		if ( strtolower( $atts['slider_height'] ) === 'fullscreen' ) {
			$atts['el_class']      .= ' fullscreen';
			$atts['slider_height'] = null;
		}

		// parse basic options first
		$atts['slick_options'] = $this->parse_options( $atts['slick_options'] );

		// generate markup for each slide
		$slides = SopranoTheme_VC_ShortcodeHelpers::param_group_parse_atts( $atts['slides'] );
		foreach ( $slides as &$slide ) {
			$slide = shortcode_atts(
				array(
					'layout'             => 'standard',
					'add_dotted_pattern' => '',
					'image'              => '',
					's_title'            => 'Business & Creative',
					's_subtitle'         => 'Multi-Concept Theme',
					's_button'           => 'Purchase Now',
					's_link'             => '#',
					't_title'            => 'Multi-Concept Theme',
					't_text'             => 'Arrived totally in as between private. Favour of so as on pretty though elinor direct. Reasonable estimating be alteration we themselves entreaties me of reasonably.',
					't_button'           => 'Purchase Now',
					't_link'             => '#',
					't_arrow'            => '',
					'v_title'            => 'Look Our Video',
					'v_subtitle'         => 'About Working Proccess',
					'v_video'            => 'http://vimeo.com/29193046',
					'b_title'            => 'Powerful WP Theme',
					'b_subtitle'         => 'Was Built Based On Experience',
					'b_button_one'       => 'Learn More',
					'b_button_two'       => 'Purchase Now',
					'b_url_one'          => '#',
					'b_url_two'          => '#',
				),
				$slide
			);
		}

		// add parsed slides attributes to main array
		$atts['slides'] = $slides;

		// render template and return it
		return $this->render_template( 'intro-slider', $atts );
	}


	/**
	 * Map shortcode in VC
	 */
	public function vc_map_shortcode() {
		// define shortcode params
		$sc_params = array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Slider height', 'soprano-ecommerce' ),
				'param_name'  => 'slider_height',
				'value'       => '475px',
				'admin_label' => true,
				'description' => esc_html__( 'Enter a valid CSS value or "fullscreen".', 'soprano-ecommerce' )
			),

			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Ken Burns effect', 'soprano-ecommerce' ),
				'param_name' => 'ken_burns',
				'value'      => array(
					esc_html__( 'Enable', 'soprano-ecommerce' ) => 'yes'
				)
			),

			array(
				'type'        => 'textarea',
				'heading'     => esc_html__( 'Custom options', 'soprano-ecommerce' ),
				'param_name'  => 'slick_options',
				'value'       => 'autoplay: true' . "\n" . 'autoplaySpeed: 7500' . "\n" . 'dots: true' . "\n" . 'infinite: true' . "\n" . 'speed: 750' . "\n" . 'arrows: true',
				'description' => wp_kses_post( __( '<b>Format:</b> option: value (one per line). <a href="http://kenwheeler.github.io/slick/#settings" target="_blank">Complete list of available options.</a>',
					'soprano-ecommerce' ) ),
			),

			array(
				'heading'    => esc_html__( 'Slides', 'soprano-ecommerce' ),
				'type'       => 'param_group',
				'param_name' => 'slides',
				'params'     => array(
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Slide Layout', 'soprano-ecommerce' ),
						'param_name' => 'layout',
						'value'      => array(
							esc_html__( 'Standard', 'soprano-ecommerce' ) => 'standard',
							esc_html__( 'Text', 'soprano-ecommerce' ) => 'text',
							esc_html__( 'Video', 'soprano-ecommerce' ) => 'video',
							esc_html__( 'Buttons', 'soprano-ecommerce' ) => 'buttons',
							esc_html__( 'Empty', 'soprano-ecommerce' ) => 'empty',
						),
						'admin_label' => true,
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Title', 'soprano-ecommerce' ),
						'param_name'  => 's_title',
						'value'       => 'Business & Creative',
			            "dependency" => array(
			                "element" => "layout",
			                "value" => 'standard',
			            ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Sub Title', 'soprano-ecommerce' ),
						'param_name'  => 's_subtitle',
						'value'       => 'Multi-Concept Theme',
			            "dependency" => array(
			                "element" => "layout",
			                "value" => 'standard',
			            ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Button', 'soprano-ecommerce' ),
						'param_name'  => 's_button',
						'value'       => 'Purchase Now',
			            "dependency" => array(
			                "element" => "layout",
			                "value" => 'standard',
			            ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Button Link', 'soprano-ecommerce' ),
						'param_name'  => 's_link',
						'value'       => '#',
			            "dependency" => array(
			                "element" => "layout",
			                "value" => 'standard',
			            ),
					),

					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Title', 'soprano-ecommerce' ),
						'param_name'  => 't_title',
						'value'       => 'Multi-Concept Theme',
			            "dependency" => array(
			                "element" => "layout",
			                "value" => 'text',
			            ),
					),
					array(
						'type'        => 'textarea',
						'heading'     => esc_html__( 'Text', 'soprano-ecommerce' ),
						'param_name'  => 't_text',
						'value'       => 'Arrived totally in as between private. Favour of so as on pretty though elinor direct. Reasonable estimating be alteration we themselves entreaties me of reasonably.',
			            "dependency" => array(
			                "element" => "layout",
			                "value" => 'text',
			            ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Button', 'soprano-ecommerce' ),
						'param_name'  => 't_button',
						'value'       => 'Purchase Now',
			            "dependency" => array(
			                "element" => "layout",
			                "value" => 'text',
			            ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Button Link', 'soprano-ecommerce' ),
						'param_name'  => 't_link',
						'value'       => '#',
			            "dependency" => array(
			                "element" => "layout",
			                "value" => 'text',
			            ),
					),
					array(
						'type'       => 'checkbox',
						'heading'    => esc_html__( 'Arrow', 'soprano-ecommerce' ),
						'param_name' => 't_arrow',
						'value'      => array(
							esc_html__( 'Enable', 'soprano-ecommerce' ) => 'yes'
						),
			            "dependency" => array(
			                "element"=> "layout",
			                "value"  => 'text',
			            ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Title', 'soprano-ecommerce' ),
						'param_name'  => 'v_title',
						'value'       => 'Look Our Video',
			            "dependency" => array(
			                "element" => "layout",
			                "value" => 'video',
			            ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Sub Title', 'soprano-ecommerce' ),
						'param_name'  => 'v_subtitle',
						'value'       => 'About Working Proccess',
			            "dependency" => array(
			                "element" => "layout",
			                "value" => 'video',
			            ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Video Link', 'soprano-ecommerce' ),
						'param_name'  => 'v_video',
						'value'       => 'http://vimeo.com/29193046',
			            "dependency" => array(
			                "element" => "layout",
			                "value" => 'video',
			            ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Title', 'soprano-ecommerce' ),
						'param_name'  => 'b_title',
						'value'       => 'Powerful WP Theme',
			            "dependency" => array(
			                "element" => "layout",
			                "value" => 'buttons',
			            ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Sub Title', 'soprano-ecommerce' ),
						'param_name'  => 'b_subtitle',
						'value'       => 'Was Bulit Based On Experience',
			            "dependency" => array(
			                "element" => "layout",
			                "value" => 'buttons',
			            ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Button #1', 'soprano-ecommerce' ),
						'param_name'  => 'b_button_one',
						'value'       => 'Learn More',
			            "dependency" => array(
			                "element" => "layout",
			                "value" => 'buttons',
			            ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Button Link #1', 'soprano-ecommerce' ),
						'param_name'  => 'b_url_one',
						'value'       => '#',
			            "dependency" => array(
			                "element" => "layout",
			                "value" => 'buttons',
			            ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Button #2', 'soprano-ecommerce' ),
						'param_name'  => 'b_button_two',
						'value'       => 'Purchase Now',
			            "dependency" => array(
			                "element" => "layout",
			                "value" => 'buttons',
			            ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Button Link #2', 'soprano-ecommerce' ),
						'param_name'  => 'b_url_two',
						'value'       => '#',
			            "dependency" => array(
			                "element" => "layout",
			                "value" => 'buttons',
			            ),
					),
					array(
						'type'        => 'attach_image',
						'heading'     => esc_html__( 'Image', 'soprano-ecommerce' ),
						'param_name'  => 'image',
						'value'       => '',
						'description' => esc_html__( 'Upload image for this slide. Recommended size is at least 1280x800px', 'soprano-ecommerce' )
					),
					array(
						'type'       => 'checkbox',
						'heading'    => esc_html__( 'Dotted overlay', 'soprano-ecommerce' ),
						'param_name' => 'add_dotted_pattern',
						'value'      => array(
							esc_html__( 'Add to background', 'soprano-ecommerce' ) => 'yes'
						)
					),
				)
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'soprano-ecommerce' ),
				'param_name'  => 'el_class',
				'value'       => '',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'soprano-ecommerce' )
			)
		);

		// now pass it all to visual composer
		vc_map( array(
			'name'     => esc_html__( 'Intro Slider', 'soprano-ecommerce' ),
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
			if ( ! trim( $line ) || strpos( $line, ':' ) === false ) { // skip invalid lines
				continue;
			}

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
return new SopranoTheme_VC_IntroSlider();