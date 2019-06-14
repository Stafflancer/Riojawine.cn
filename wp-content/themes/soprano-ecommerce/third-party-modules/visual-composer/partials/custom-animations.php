<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_CustomAnimations {


	/**
	 * SopranoTheme_VC_CustomAnimations constructor.
	 */
	public function __construct() {
		add_filter( 'do_shortcode_tag', array( $this, 'customize_shortcode_content' ), 10, 3 );
		add_action( 'vc_after_init', array( $this, 'setup_custom_animation_options' ) );
	}


	/**
	 * Removes default animation options and applies our custom ones
	 */
	public function setup_custom_animation_options() {
		$shortcodes = WPBMap::getAllShortCodes();

		$custom_animation_attributes = array(
			array(
				'type'       => 'animation_style',
				'heading'    => esc_html__( 'Animation', 'soprano-ecommerce' ),
				'param_name' => 'pzt_animation_name',
				'group'      => esc_html__( 'Entrance animations', 'soprano-ecommerce' )
			),

			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Animation delay', 'soprano-ecommerce' ),
				'param_name'  => 'pzt_animation_delay',
				'description' => esc_html__( 'Enter CSS-valid value like 1s or 250ms.', 'soprano-ecommerce' ),
				'group'       => esc_html__( 'Entrance animations', 'soprano-ecommerce' )
			),

			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Animation duration', 'soprano-ecommerce' ),
				'param_name'  => 'pzt_animation_duration',
				'description' => esc_html__( 'Enter CSS-valid value like 1s or 250ms.', 'soprano-ecommerce' ),
				'group'       => esc_html__( 'Entrance animations', 'soprano-ecommerce' )
			),
		);
		$sequenced_animation_param = array(
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Make this animation sequenced?', 'soprano-ecommerce' ),
				'param_name'  => 'pzt_sequenced_animation',
				'group'       => esc_html__( 'Entrance animations', 'soprano-ecommerce' ),
				'description' => esc_html__( 'If checked, animation settings above will be applied to children of this widget in a sequenced order.', 'soprano-ecommerce' ),
				'value'       => array(
					esc_html__( 'Yes', 'soprano-ecommerce' ) => 'yes'
				)
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Children element selector', 'soprano-ecommerce' ),
				'param_name'  => 'pzt_animation_children_selector',
				'description' => esc_html__( 'Enter CSS-valid selector or leave empty.', 'soprano-ecommerce' ),
				'group'       => esc_html__( 'Entrance animations', 'soprano-ecommerce' ),
				'dependency'  => array(
					'element' => 'pzt_sequenced_animation',
					'value'   => 'yes'
				),
			),
		);

		// remove animation param everywhere
		// and then add our custom ones
		foreach ( $shortcodes as $shortcode_base => $shortcode_data ) {
			if ( isset( $shortcode_data['params'] ) && is_array( $shortcode_data['params'] ) ) {
				vc_remove_param( $shortcode_base, 'css_animation' );
				vc_add_params( $shortcode_base, $custom_animation_attributes );
			}

			$is_container         = isset( $shortcode_data['is_container'] ) && $shortcode_data['is_container'];
			$sequenced_animations = isset( $shortcode_data['add_sequenced_animations'] ) && $shortcode_data['add_sequenced_animations'];
			if ( $is_container || $sequenced_animations ) {
				vc_add_params( $shortcode_base, $sequenced_animation_param );
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
		$container_atts = array();
		$container_class = null;

		// parse animation options
		$a_options = shortcode_atts(
			array(
				'pzt_animation_name'              => '',
				'pzt_animation_delay'             => '',
				'pzt_animation_duration'          => '',
				'pzt_sequenced_animation'         => '',
				'pzt_animation_children_selector' => ''
			),
			$shortcode_atts
		);

		// set animation name
		if ( $a_options['pzt_animation_name'] && $a_options['pzt_animation_name'] !== 'none' ) {
			$container_class = ' wow ' . esc_attr( $a_options['pzt_animation_name'] );

			if ( $a_options['pzt_sequenced_animation'] === 'yes' ) {
				$container_class = ' wow sequenced fx-' . esc_attr( $a_options['pzt_animation_name'] );
			}
		}

		// set delay
		if( $a_options['pzt_animation_delay'] ) {
			$container_atts['data-wow-delay'] = $a_options['pzt_animation_delay'];
		}

		// set duration
		if( $a_options['pzt_animation_duration'] ) {
			$container_atts['data-wow-duration'] = $a_options['pzt_animation_duration'];
		}

		// set children selector
		if ( $a_options['pzt_animation_children_selector'] ) {
			$container_atts['data-wow-children'] = $a_options['pzt_animation_children_selector'];
		}

		// generate new output if needed
		if ( $container_class ) {
			$container_atts = ( ! empty( $container_atts ) ) ? ' ' . html_build_attributes( $container_atts ) : '';
			$pattern        = '/<([a-z0-9-_].*)class=(?<quote>"|\')(.*)\k<quote>(.*)>/iU';
			$replace        = '<$1class=$2$3' . $container_class . '$2$4' . $container_atts . '>';

			return preg_replace( $pattern, $replace, $output, 1 );
		} else {
			return $output;
		}
	}

}

new SopranoTheme_VC_CustomAnimations();