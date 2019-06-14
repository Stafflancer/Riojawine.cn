<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_FeedbackTeaser {

	/**
	 * @var int
	 */
	private $tease_interval = WEEK_IN_SECONDS;

	/**
	 * @var bool
	 */
	private $admin_page_correct = false;


	/**
	 * SopranoTheme_FeedbackTeaser constructor.
	 */
	public function __construct() {
		if ( current_user_can( 'switch_themes' ) ) {
			if ( $this->teaser_should_appear_now() ) {
				add_action( 'admin_notices', array( $this, 'show_teaser' ) );
				add_action( 'current_screen', array( $this, 'check_admin_page' ) );
			}

			if ( wp_doing_ajax() ) {
				add_action( 'wp_ajax_pzt_sp_teaser', array( $this, 'teaser_ajax_action' ) );
			}
		} else {
			$this->theme_first_installation_date();
		}
	}


	/**
	 * Checks whether notice should be shown on current admin page
	 *
	 * @param $screen WP_Screen
	 */
	public function check_admin_page( $screen ) {
		// $this->admin_page_correct = ( $screen->base === 'dashboard' );
		$this->admin_page_correct = true; // temp solution
	}


	/**
	 * Prints out notice markup
	 */
	public function show_teaser() {
		if ( $this->admin_page_correct ) {
			include get_parent_theme_file_path( 'third-party-modules/feedback-teaser/notice-template.php' );
		}
	}


	/**
	 * Retrieve first theme installation date
	 *
	 * @return int
	 */
	private function theme_first_installation_date() {
		$option_key   = 'pzt/soprano_theme/first_installation_date';
		$install_date = get_option( $option_key );

		if ( ! $install_date ) {
			$install_date = time();
			update_option( $option_key, $install_date, true );
		}

		return $install_date;
	}


	/**
	 * Decides whether teaser should be shown right now
	 *
	 * @return bool
	 */
	private function teaser_should_appear_now() {
		$option_key       = 'pzt/soprano_theme/next_rt_appear_time';
		$next_appear_time = get_option( $option_key );

		if ( $next_appear_time === false ) {
			$next_appear_time = $this->theme_first_installation_date() + $this->tease_interval;
			update_option( $option_key, $next_appear_time, true );
		}

		if ( defined( 'PZT_DEBUG_FB_TEASER' ) && PZT_DEBUG_FB_TEASER ) {
			return true;
		}

		return ( intval( $next_appear_time ) !== - 1 && time() >= $next_appear_time );
	}


	/**
	 * Process AJAX call from teaser front-end
	 */
	public function teaser_ajax_action() {
		check_ajax_referer();
        $option_key = 'pzt/soprano_theme/next_rt_appear_time';

		if ( $_GET['teaser_action'] === 'snooze' ) {
			update_option( $option_key, time() + ( 3 * DAY_IN_SECONDS ) );
		}

		if ( $_GET['teaser_action'] === 'close' ) {
			update_option( $option_key, -1 );
		}

		wp_die();
	}

}


/**
 * Hook module initialization to `admin_init` point
 */
add_action(
	'admin_init',
	function () {
		new SopranoTheme_FeedbackTeaser();
	}
);