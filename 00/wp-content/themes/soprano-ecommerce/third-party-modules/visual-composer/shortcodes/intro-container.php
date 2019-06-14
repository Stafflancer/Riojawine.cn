<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_IntroContainer extends SopranoTheme_VC_ShortcodeBase {

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
				'height'                  => '475px',
				'ken_burns'               => '',
				'add_dotted_pattern'      => '',
				'bg_type'                 => 'image',
				'youtube_url'             => '',
				'video_start'             => '',
				'video_end'               => '',
				'video_placeholder_image' => '',
				'bg_image'                => '',
				'el_class'                => '',
			),
			$atts
		);

		if ( $atts['bg_type'] === 'image' ) { $atts['el_class'] .= ' sp-intro-image'; }
		if ( $atts['bg_type'] === 'video' ) { $atts['el_class'] .= ' sp-intro-video'; }
		if ( $atts['ken_burns'] === 'yes' ) { $atts['el_class'] .= ' kenburns'; }

		if ( strtolower( $atts['height'] ) === 'fullscreen' ) {
			$atts['el_class'] .= ' fullscreen';
			$atts['height']   = null;
		}

		$atts['content'] = $content;

		return $this->render_template( 'intro-container', $atts );
	}


	/**
	 * Map shortcode in VC
	 */
	public function vc_map_shortcode() {
		// define shortcode params
		$sc_params = array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Intro height', 'soprano-ecommerce' ),
				'param_name'  => 'height',
				'value'       => '475px',
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
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Dotted overlay', 'soprano-ecommerce' ),
				'param_name' => 'add_dotted_pattern',
				'value'      => array(
					esc_html__( 'Add to background', 'soprano-ecommerce' ) => 'yes'
				)
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Intro background type', 'soprano-ecommerce' ),
				'param_name' => 'bg_type',
				'value'      => array(
					esc_html__( 'Image', 'soprano-ecommerce' ) => 'image',
					esc_html__( 'Video', 'soprano-ecommerce' ) => 'video',
				),
			),

			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'YouTube video URL', 'soprano-ecommerce' ),
				'param_name'  => 'youtube_url',
				'value'       => '',
				'description' => esc_html__( 'Youtu.be short links are supported.', 'soprano-ecommerce' ),
				'dependency'  => array(
					'element' => 'bg_type',
					'value'   => 'video'
				),
			),

			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Video start position', 'soprano-ecommerce' ),
				'param_name'  => 'video_start',
				'value'       => '',
				'description' => esc_html__( 'Enter value in seconds or leave this field empty.', 'soprano-ecommerce' ),
				'dependency'  => array(
					'element' => 'bg_type',
					'value'   => 'video'
				),
			),

			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Video end position', 'soprano-ecommerce' ),
				'param_name'  => 'video_end',
				'value'       => '',
				'description' => esc_html__( 'Enter value in seconds or leave this field empty.', 'soprano-ecommerce' ),
				'dependency'  => array(
					'element' => 'bg_type',
					'value'   => 'video'
				),
			),

			array(
				'type'        => 'attach_image',
				'heading'     => esc_html__( 'Video placeholder image', 'soprano-ecommerce' ),
				'param_name'  => 'video_placeholder_image',
				'description' => esc_html__( 'Will be shown until video is loaded and on mobile devices where backgrpund videos is not properly supported.', 'soprano-ecommerce' ),
				'dependency'  => array(
					'element' => 'bg_type',
					'value'   => 'video'
				),
			),

			array(
				'type'        => 'attach_image',
				'heading'     => esc_html__( 'Intro background image', 'soprano-ecommerce' ),
				'param_name'  => 'bg_image',
				'description' => esc_html__( 'Upload background image for this intro block.', 'soprano-ecommerce' ),
				'dependency'  => array(
					'element' => 'bg_type',
					'value'   => 'image'
				),
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
			'name'            => esc_html__( 'Intro Container', 'soprano-ecommerce' ),
			'base'            => $this->shortcode_base(),
			'category'        => esc_html__( 'Soprano Theme', 'soprano-ecommerce' ),
			'as_parent'       => array(
				'only' => array(
					'soprano_theme_intro_inner_text',
					'soprano_theme_button',
					'soprano_theme_intro_inner_scrolldown'
				)
			),
			'content_element' => true,
			'is_container'    => true,
			'js_view'         => 'VcColumnView',
			'params'          => $sc_params,
		) );
	}

}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Soprano_Theme_Intro_Container extends WPBakeryShortCodesContainer {}
}

// the file should always return shortcode instance
return new SopranoTheme_VC_IntroContainer();