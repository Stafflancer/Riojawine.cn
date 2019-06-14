<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_TestimonialsSlider extends SopranoTheme_VC_ShortcodeBase {

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
				'slides'   => '',
				'el_class' => ''
			),
			$atts
		);

		// parse array of slides
		$slides = SopranoTheme_VC_ShortcodeHelpers::param_group_parse_atts( $atts['slides'] );
		foreach ( $slides as &$slide ) {
			$slide = shortcode_atts(
				array(
					'text'   => '',
					'image'  => '',
					'author' => '',
				),
				$slide
			);
		}

		// add parsed slides attributes to main array
		$atts['slides'] = $slides;

		// render template and return it
		return $this->render_template( 'testimonials', $atts );
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
						'type'        => 'textarea',
						'heading'     => esc_html__( 'Text', 'soprano-ecommerce' ),
						'param_name'  => 'text',
						'value'       => '',
						'description' => esc_html__( 'Basic HTML and shortcodes is allowed.', 'soprano-ecommerce' ),
						'admin_label' => true
					),

					array(
						'type'        => 'attach_image',
						'heading'     => esc_html__( 'Author image', 'soprano-ecommerce' ),
						'param_name'  => 'image',
						'value'       => '',
						'description' => esc_html__( 'Upload image for this slide. Recommended size is 160x160.', 'soprano-ecommerce' )
					),

					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Author', 'soprano-ecommerce' ),
						'param_name'  => 'author',
						'value'       => '',
						'description' => esc_html__( 'Enter testimonial author.', 'soprano-ecommerce' )
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
			'name'     => esc_html__( 'Testimonials Slider', 'soprano-ecommerce' ),
			'base'     => $this->shortcode_base(),
			'category' => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'params'   => $sc_params,
		) );
	}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_TestimonialsSlider();