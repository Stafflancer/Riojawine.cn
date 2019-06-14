<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_CustomParams {

	/**
	 * Affected elements
	 * @var array
	 */
	private $affected_elems = array(
		'vc_section', 'vc_row', 'vc_row_inner', 'vc_column', 'vc_column_inner', 'vc_column_text',
	    'soprano_theme_text'
	);


	/**
	 * SopranoTheme_VC_CustomParams constructor.
	 */
	public function __construct() {
		add_filter( 'do_shortcode_tag', array( $this, 'customize_shortcode_content' ), 10, 3 );
		add_action( 'vc_after_init', array( $this, 'setup_custom_options' ) );
	}


	/**
	 * Removes default animation options and applies our custom ones
	 */
	public function setup_custom_options() {
		$shortcodes = WPBMap::getAllShortCodes();
		$custom_options = array(
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Text alignment', 'soprano-ecommerce' ),
				'param_name'  => 'pzt_text_alignment',
				'description' => esc_html__( 'Select text alignment side. If none selected - value will be inherited from parent element.', 'soprano-ecommerce' ),
				'weight'      => 5,
				'value'       => array(
					esc_html__( 'None (default)', 'soprano-ecommerce' ) => '',
					esc_html__( 'Left', 'soprano-ecommerce' )           => 'text-left',
					esc_html__( 'Center', 'soprano-ecommerce' )         => 'text-center',
					esc_html__( 'Right', 'soprano-ecommerce' )          => 'text-right',
				)
			),
		);

		// add custom options only for specified widgets
		foreach ( $shortcodes as $shortcode_base => $shortcode_data ) {
			if ( in_array( $shortcode_base, $this->affected_elems ) ) {
				vc_add_params( $shortcode_base, $custom_options );
			}
		}
	}


	/**
	 * Customize shortcode output according to shortcode options
	 *
	 * @param $output
	 * @param $shortcode_instance
	 * @param $shortcode_atts
	 *
	 * @return string
	 */
	public function customize_shortcode_content( $output, $shortcode_instance, $shortcode_atts ) {
		// parse custom options
		$a_options = shortcode_atts(
			array( 'pzt_text_alignment' => '', ),
			$shortcode_atts
		);

		// generate new output if needed
		if ( $a_options['pzt_text_alignment'] ) {
			$pattern        = '/<([a-z0-9-_].*)class=(?<quote>"|\')(.*)\k<quote>(.*)>/iU';
			$replace        = '<$1class=$2$3 ' . $a_options['pzt_text_alignment'] . '$2$4>';

			return preg_replace( $pattern, $replace, $output, 1 );
		} else {
			return $output;
		}
	}

}

new SopranoTheme_VC_CustomParams();