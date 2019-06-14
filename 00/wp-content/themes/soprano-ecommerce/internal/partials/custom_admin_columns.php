<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_CustomAdminColumns {

	/**
	 * SopranoTheme_CustomAdminColumns constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init_custom_columns' ) );
	}


	/**
	 * Initialize custom columns functions
	 */
	public function init_custom_columns() {
		$custom_post_types = get_post_types(
			array( '_builtin' => false ),
			'names'
		);

		$custom_post_types[] = 'post';

		foreach ( $custom_post_types as $post_type ) {
			if ( substr( $post_type, 0, 3 ) !== 'sp-' && $post_type !== 'post' ) {
				continue;
			}

			add_filter( 'manage_' . $post_type . '_posts_columns', array( $this, 'add_id_column' ) );

			if ( post_type_supports( $post_type, 'thumbnail' ) ) {
				add_filter( 'manage_' . $post_type . '_posts_columns', array( $this, 'add_thumb_column' ) );
			}

			add_action(
				'manage_' . $post_type . '_posts_custom_column',
				array( $this, 'manage_custom_column_content' ),
				10, 2
			);
		}
	}


	/**
	 * Adds "featured thumbnail" column to admin post listings
	 *
	 * @param $columns
	 *
	 * @return array
	 */
	public function add_thumb_column($columns) {
		$checkbox = array_slice( $columns, 0, 1 );
		$columns  = array_slice( $columns, 1 );

		$id['featured_thumb'] = esc_html__( 'Thumbnail', 'soprano-ecommerce' );
		$columns              = array_merge( $checkbox, $id, $columns );

		return $columns;
	}


	/**
	 * Adds "ID" column to admin post listings
	 *
	 * @param $columns
	 *
	 * @return array
	 */
	public function add_id_column($columns) {
		$checkbox = array_slice( $columns, 0, 1 );
		$columns  = array_slice( $columns, 1 );

		$id['revealid_id'] = esc_html__( 'ID', 'soprano-ecommerce' );
		$columns           = array_merge( $checkbox, $id, $columns );

		return $columns;
	}


	/**
	 * Generates content for custom columns
	 *
	 * @param $column
	 * @param $id
	 */
	public function manage_custom_column_content($column, $id) {
		if ( 'revealid_id' == $column ) {
			echo '<span class="pzt_revealid_column">' . esc_html( $id ) . '</span>';
		}

		if ( 'featured_thumb' == $column ) {
			if ( has_post_thumbnail() ) {
				$thumb_id     = get_post_thumbnail_id();
				$thumb_markup = wp_get_attachment_image( $thumb_id, 'medium' );
				echo sp_theme_build_tag( 'a', array( 'href' => get_edit_post_link() ), $thumb_markup );
			} else {
				echo '<p>' . esc_html__( 'Featured image is not set.', 'soprano-ecommerce' ) . '</p>';
			}
		}
	}

}

new SopranoTheme_CustomAdminColumns();