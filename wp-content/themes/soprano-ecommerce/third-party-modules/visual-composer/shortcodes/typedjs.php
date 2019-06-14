<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_Typed extends SopranoTheme_VC_ShortcodeBase {

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
					'classes' => '',
					'str'     => '',
					'repeat'  => 'yes',
					'cursor'  => 'yes'
				),
				$atts )
		);

		$elem_atts = array(
			'class'             => $classes,
			'data-typed-str'    => htmlspecialchars( trim( $str, '"\'' ) ),
			'data-typed-repeat' => ( $repeat && ( $repeat == 1 || $repeat == 'yes' ) ) ? 'yes' : 'no',
			'data-typed-cursor' => ( $cursor && ( $cursor == 1 || $cursor == 'yes' ) ) ? 'yes' : 'no'
		);

		return sp_theme_build_tag( 'span', $elem_atts );
	}


	/**
	 * We don't map this shortcode to VC
	 */
	public function vc_map_shortcode() {}

}

// the file should always return shortcode instance
return new SopranoTheme_VC_Typed();