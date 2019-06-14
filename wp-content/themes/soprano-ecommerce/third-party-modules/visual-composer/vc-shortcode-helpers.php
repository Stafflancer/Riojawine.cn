<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_VC_ShortcodeHelpers {

	private static $uniqid;

	/**
	 * Fallback for VC's "vc_build_link" function
	 *
	 * @param $value
	 *
	 * @return array
	 */
	public static function build_link( $value ) {
		if ( function_exists( 'vc_build_link' ) ) {
			return vc_build_link( $value );
		}

		$result       = array( 'url' => '', 'title' => '', 'target' => '', 'rel' => '' );
		$params_pairs = explode( '|', $value );
		if ( ! empty( $params_pairs ) ) {
			foreach ( $params_pairs as $pair ) {
				$param = preg_split( '/\:/', $pair );
				if ( ! empty( $param[0] ) && isset( $param[1] ) ) {
					$result[ $param[0] ] = rawurldecode( $param[1] );
				}
			}
		}

		return $result;
	}


	/**
	 * Fallback for VC's "vc_param_group_parse_atts" function
	 *
	 * @param $atts_string
	 *
	 * @return array|mixed
	 */
	public static function param_group_parse_atts( $atts_string ) {
		if ( function_exists( 'vc_param_group_parse_atts' ) ) {
			return vc_param_group_parse_atts( $atts_string );
		}

		$array = json_decode( urldecode( $atts_string ), true );

		return $array;
	}


	/**
	 * Fallback for VC's "vc_shortcode_custom_css_class" function
	 *
	 * @param        $param_value
	 * @param string $prefix
	 *
	 * @return string
	 */
	public static function custom_css_class( $param_value, $prefix = '' ) {
		if ( function_exists( 'vc_shortcode_custom_css_class' ) ) {
			return vc_shortcode_custom_css_class( $param_value, $prefix );
		}

		$css_class = preg_match( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', $param_value ) ? $prefix . preg_replace( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', '$1', $param_value ) : '';

		return $css_class;
	}


	/**
	 * Normalizes autop input
	 *
	 * @param      $content
	 * @param bool $autop
	 *
	 * @return string
	 */
	public static function normalize_wpautop($content, $autop = false) {
		if ( function_exists( 'wpb_js_remove_wpautop' ) ) {
			return wpb_js_remove_wpautop( $content, $autop );
		}

		if ( $autop ) { // Possible to use !preg_match('('.WPBMap::getTagsRegexp().')', $content)
			$content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
		}

		return do_shortcode( shortcode_unautop( $content ) );
	}


	/**
	 * Generates unique identifier and return it
	 *
	 * @param null $prefix
	 *
	 * @return int|string
	 */
	public static function uniqid( $prefix = null ) {
		if ( self::$uniqid === null ) { self::$uniqid = rand(); }
		self::$uniqid += 1;

		return ( $prefix ) ? $prefix . self::$uniqid : self::$uniqid;
	}
}