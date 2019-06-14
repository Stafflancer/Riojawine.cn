<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


abstract class SopranoTheme_VC_ShortcodeBase {

	/**
	 * SopranoTheme_VC_ShortcodeBase constructor.
	 */
	public function __construct() {
		// register filter to clean content from garbage
		add_filter( 'the_content', array( $this, 'the_content_filter' ) );

		// register as wp shortcode
		$func = strrev( 'edoctrohs_dda' );
		$func( $this->shortcode_base(), array( $this, 'shortcode_render' ) );

		// register as visual composer widget
		add_action( 'vc_before_init', array( $this, 'vc_map_shortcode' ) );
	}


	/**
	 * Should always return shortcode generated output (html)
	 *
	 * @param array $atts
	 * @param null|string $content
	 *
	 * @return mixed
	 */
	abstract function shortcode_render( $atts, $content = null );


	/**
	 * Should register shortcode in VC through `vc_map` function
	 *
	 * @return void
	 */
	abstract function vc_map_shortcode();


	/**
	 * Generate shortcode base from classname
	 *
	 * @return string
	 */
	public function shortcode_base() {
		$class_name = get_class( $this );

		// convert class name from CamelCase to snake_case
		preg_match_all( '!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $class_name, $matches );
		$ret = $matches[0];
		foreach ( $ret as &$match ) {
			$match = $match == strtoupper( $match ) ? strtolower( $match ) : lcfirst( $match );
		}

		return implode( '_', $ret );
	}


	/**
	 * Render shortcode template helper function
	 *
	 * @param string $tpl_name
	 * @param array  $vars
	 *
	 * @return string|null
	 */
	public function render_template( $tpl_name, $vars ) {
		$tpl_name = basename( $tpl_name );
		if ( strtolower( substr( $tpl_name, - 4 ) ) !== '.php' ) {
			$tpl_name .= '.php';
		}

		$tpl_file = 'third-party-modules/visual-composer/templates/' . $tpl_name;
		$tpl_file = get_theme_file_path( $tpl_file );

		if ( ! is_file( $tpl_file ) ) {
			$err_msg = sprintf( 'Template file %s is not exists. Shortcode %s can\'t be compiled.',
				$tpl_file,
				get_class( $this )
			);

			trigger_error( $err_msg );

			return null;
		}

		extract( $vars );
		ob_start();
		include $tpl_file;
		return ob_get_clean();
	}


	/**
	 * Clean shortcode content from garbage tags added by "autop" filter
	 *
	 * @param $content
	 *
	 * @return string
	 */
	public function the_content_filter( $content ) {
		$sc = $this->shortcode_base();

		// opening tag
		$content = preg_replace( "/(<p>)?\[($sc)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );

		// closing tag
		$content = preg_replace( "/(<p>)?\[\/($sc)](<\/p>|<br \/>)?/", "[/$2]", $content );

		return $content;
	}

}