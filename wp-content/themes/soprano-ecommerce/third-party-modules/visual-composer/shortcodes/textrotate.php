<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_TextRotate extends SopranoTheme_VC_ShortcodeBase {

	/**
	 * Shortcode HTML output
	 *
	 * @param array $atts
	 * @param null|string $content
	 *
	 * @return string
	 */
	public function shortcode_render( $atts, $content = null ) {
		// attributes
		extract( shortcode_atts(
				array(
					'str'       => '',
					'animation' => 'dissolve',
					'speed'     => '2500',
					'el_class'  => ''
				),
				$atts )
		);

		// possible animation values are:
		// dissolve (default), fade, flip, flipUp, flipCube, flipCubeUp and spin

		$elem_atts = array(
			'class'          => 'sp-text-rotate ' . $el_class,
			'data-animation' => $animation,
			'data-speed'     => $speed
		);

		return sp_theme_build_tag( 'span', $elem_atts, $str );
	}


	/**
	 * We don't map this shortcode to VC
	 */
	public function vc_map_shortcode() {}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_TextRotate();