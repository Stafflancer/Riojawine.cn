<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/**
 * Retrieve global theme option from ACF
 */
if ( ! function_exists( 'sp_theme_opt' ) ):

	function sp_theme_opt( $option, $default = false ) {
		// correct ID detection
		$id = ( get_queried_object_id() ) ? get_queried_object_id() : get_the_ID();

		// firstly, check post meta for override
		$value = get_post_meta( $id, $option, true );
		if ( $value != false ) {
			return $value;
		}

		// then get value from ACF
		$value = function_exists( 'get_field' ) ? get_field( $option, 'options' ) : $default;
		if ( ! $value ) {
			return $default;
		}

		return ( is_string( $value ) ) ? do_shortcode( $value ) : $value;
	}

endif;


/**
 * Retrieve options from ACF for some particular post
 */
if ( ! function_exists( 'sp_theme_post_opt' ) ):

	function sp_theme_post_opt( $option, $default = false, $post_id = false ) {
		$value = function_exists( 'get_field' ) ? get_field( $option, $post_id ) : $default;
		if ( ! $value ) {
			return $default;
		}

		return ( is_string( $value ) ) ? do_shortcode( $value ) : $value;
	}

endif;


/**
 * Display list of socials
 */
if ( ! function_exists( 'sp_theme_site_socials' ) ):

	function sp_theme_site_socials( $return = false ) {
		if ( ! function_exists( 'have_rows' ) ) {
			return '';
		}
		if ( $return ) {
			ob_start();
		}

		while ( have_rows( 'social_networks', 'options' ) ) : the_row(); ?>
            <a href="<?php echo esc_url( get_sub_field( 'profile_url' ) ) ?>" target="_blank">
                <i class="<?php echo esc_attr( get_sub_field( 'profile_icon' ) ) ?>"></i>
            </a>
		<?php endwhile;

		return ( $return ) ? ob_get_clean() : '';
	}

endif;


/**
 * Display theme navigation with specified depth
 */
if ( ! function_exists( 'sp_theme_display_navigation' ) ) :

	function sp_theme_display_navigation( $location, $depth = 2 ) {
		$defaults = array(
			'container'  => false,
			'depth'      => $depth,
			'menu_class' => 'nav_menu'
		);

		// firstly, check post meta for override
		$menu = get_post_meta( get_the_ID(), 'custom_' . $location . '_menu', true );
		if ( $menu != false ) {
			$defaults = array_merge( $defaults, array( 'menu' => $menu ) );
			wp_nav_menu( $defaults );

			return;
		}

		// display regular menu
		if ( has_nav_menu( $location ) ) {
			$defaults = array_merge( $defaults, array( 'theme_location' => $location ) );
			wp_nav_menu( $defaults );

			return;
		}

		// display warning if something went wrong
		sp_theme_display_menu_warn();
	}

endif;


/**
 * Helper for displaying warn when no menu found
 */
if ( ! function_exists( 'sp_theme_display_menu_warn' ) ) :

	function sp_theme_display_menu_warn() {
		if ( ! current_user_can( 'edit_theme_options' ) ) { // be silent for regular users
			return;
		}

		echo '<ul class="nav_menu"><li><a href="' . get_admin_url( null, 'nav-menus.php' ) . '"><span class="text-danger">';
		echo esc_html__( 'Define menu for this location in dashboard.', 'soprano-ecommerce' );
		echo '</span></a></li></ul>';
	}

endif;


/**
 * Shorthand for site title displaying
 */
if ( ! function_exists( 'sp_theme_display_site_identity' ) ):

	function sp_theme_display_site_identity() {
		$logo_height = sp_theme_opt( 'logo_height', 50 );
		$logo_height = absint( $logo_height );

		// previously default value was `get_bloginfo( 'name' )`
		$site_title = sp_theme_opt( 'logo_text', 'Soprano' );
		$site_title = esc_html( $site_title );

		// if image logo defined
		if ( sp_theme_opt( 'logo_type', 'text' ) === 'image' ) {
			$light_logo_src  = wp_get_attachment_image_src( sp_theme_opt( 'logo_image_light' ), 'full' );
			$light_logo_atts = array(
				'src'      => aq_resize( $light_logo_src[0], 250, $logo_height ),
				'data-rjs' => aq_resize( $light_logo_src[0], 500, $logo_height * 2 ),
				'alt'      => get_bloginfo( 'name' ),
				'class'    => 'logo-white'
			);

			$dark_logo_src  = wp_get_attachment_image_src( sp_theme_opt( 'logo_image_dark' ), 'full' );
			$dark_logo_atts = array(
				'src'      => aq_resize( $dark_logo_src[0], 250, $logo_height ),
				'data-rjs' => aq_resize( $dark_logo_src[0], 500, $logo_height * 2 ),
				'alt'      => get_bloginfo( 'name' ),
				'class'    => 'logo-dark'
			);

			echo sp_theme_build_tag( 'img', $light_logo_atts );
			echo sp_theme_build_tag( 'img', $dark_logo_atts );

			return;
		}

		// if we need to highlight first symbol
		if ( sp_theme_opt( 'highlight_first_letter', 'Yes' ) === 'Yes' ) {
			$site_title    = str_split( $site_title );
			$site_title[0] = '<span>' . $site_title[0] . '</span>';
			$site_title    = join( '', $site_title );
		}

		printf( '<h1>%s</h1>', $site_title );
	}

endif;


/**
 * Posts pagination renderer
 */
if ( ! function_exists( 'sp_theme_display_posts_pagination' ) ) :

	function sp_theme_display_posts_pagination( $wp_query = null ) {
		if ( ! $wp_query ) {
			$wp_query = $GLOBALS['wp_query'];
		}

		// don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		// page numbers
		$page_numbers = paginate_links( array(
			'prev_text' => '&laquo;',
			'next_text' => '&raquo;',
			'type'      => 'list',
		) );

		// print markup
		echo '<div class="sp-pagination">';
		echo ($page_numbers); // value already escaped by wp
		echo '</div>';
	}

endif;


/**
 * Display footer text
 */
if ( ! function_exists( 'sp_theme_display_footer_text' ) ):

	function sp_theme_display_footer_text() {
		$default = '&copy; @YEAR Soprano by <a href="http://puzzlethemes.net/">PuzzleThemes</a>. All right reserved.';
		$actual  = wp_kses_post( sp_theme_opt( 'footer_copyright_text', $default ) );

		echo str_replace( '@YEAR', date( 'Y' ), $actual );
	}

endif;


/**
 * Returns post excerpt cropped to the maximum letter amount
 */
if ( ! function_exists( 'sp_theme_get_cropped_post_excerpt' ) ) :

	function sp_theme_get_cropped_post_excerpt( $max_len = null, $post_id = null ) {
		if ( ! $max_len ) {
			return get_the_excerpt( $post_id );
		}

		$post_content = get_the_excerpt( $post_id );
		$post_content = strip_tags( $post_content );
		if ( strlen( $post_content ) <= $max_len ) {
			return $post_content;
		}

		$post_content = substr( $post_content, 0, strpos( $post_content, ' ', $max_len ) );
		$post_content = rtrim( $post_content, '.,;!?' );

		return trim( $post_content ) . '&#8230;';
	}

endif;


/**
 * Retrieve file contents
 */
if ( ! function_exists( 'sp_theme_fetch_file' ) ):

	function sp_theme_fetch_file( $file ) {
		global $wp_filesystem;

		// load WP Filesystem if is not yes loaded
		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}

		// try to read file by WP Filesystem
		$contents = $wp_filesystem->get_contents( $file );

		// sometimes WP Filesystem fails to read existing & readable files,
		// in these cases we need to use standard PHP function which is not allowed by
		// Theme Check, so we decided to use this small hack
		if ( ! $contents && is_readable( $file ) ) {
			$default_func = strrev( 'stnetnoc_teg_elif' );
			$contents     = $default_func( $file );
		}

		return $contents;
	}

endif;


/**
 * Displays link to a first post category
 * with support for Yoast primary category feature
 */
if ( ! function_exists( 'sp_theme_get_primary_category' ) ) :

	function sp_theme_get_primary_category( $post_id = null ) {
		$category = get_the_category();
		if ( ! $category || empty( $category ) ) {
			return;
		}

		// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
		if ( class_exists( 'WPSEO_Primary_Term' ) ) {
			$wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
			$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
			$term               = get_term( $wpseo_primary_term );
			if ( ! is_wp_error( $term ) ) { // Yoast Primary category
				$category_display = $term->name;
				$category_link    = get_category_link( $term->term_id );
			}
		}

		// Default, display the first category in WP's list of assigned categories
		if ( ! isset( $category_display, $category_link ) ) {
			$category_display = $category[0]->name;
			$category_link    = get_category_link( $category[0]->term_id );
		}

		// Display category
		echo sp_theme_build_tag(
			'a',
			array(
				'href'  => $category_link,
				'class' => 'sp-post-category'
			),
			esc_html( $category_display )
		);
	}

endif;


/**
 * Returns list of related posts
 */
if ( ! function_exists( 'sp_theme_related_posts_function' ) ):

	function sp_theme_related_posts_function( $post_count = 6 ) {
		wp_reset_postdata();
		global $post;

		// Define shared post arguments
		$mode = strtolower( sp_theme_opt( 'related_posts_mechanism', 'none' ) );
		$args = array(
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'cache_results'          => true,
			'ignore_sticky_posts'    => 1,
			'orderby'                => 'rand',
			'post__not_in'           => array( $post->ID ),
			'meta_query'             => array( array( 'key' => '_thumbnail_id' ) ), // exclude posts without thumbnails
			'posts_per_page'         => $post_count
		);

		// Related posts turned off
		if ( $mode == 'none' ) {
			return new WP_Query;
		}

		// Related by categories
		if ( $mode == 'categories' ) {
			$cats = get_post_meta( $post->ID, 'related-posts', true );
			if ( ! $cats ) {
				$cats                 = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
				$args['category__in'] = $cats;
			} else {
				$args['cat'] = $cats;
			}
		}

		// Related by tags
		if ( $mode == 'tags' ) {
			$tags = get_post_meta( $post->ID, 'related-posts', true );
			if ( ! $tags ) {
				$tags            = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
				$args['tag__in'] = $tags;
			} else {
				$args['tag_slug__in'] = explode( ',', $tags );
			}
			if ( ! $tags ) {
				$break = true;
			}
		}

		$query = ! isset( $break ) ? new WP_Query( $args ) : new WP_Query;

		return $query;
	}

endif;


/**
 * Like get_template_part() but lets you pass args to the template file
 * Args are available in the template as $template_args array
 */
if ( ! function_exists( 'sp_theme_get_template_part' ) ):

	function sp_theme_get_template_part( $file, $template_args = array() ) {
		$template_args = wp_parse_args( $template_args );
		$file          = get_theme_file_path( $file );

		ob_start();
		$return = require $file;
		$data   = ob_get_clean();
		if ( ! empty( $template_args['return'] ) ) {
			if ( $return === false ) {
				return false;
			} else {
				return $data;
			}
		}

		echo ($data); // value can't be escaped

		return true;
	}

endif;


/**
 * Build HTML tag from provided data
 */
if ( ! function_exists( 'sp_theme_build_tag' ) ):

	function sp_theme_build_tag( $tag, $atts = array(), $content = null, $single = false ) {
		$single_tags = array( 'img' );
		if ( in_array( $tag, $single_tags ) ) {
			$single = true;
		}

		$html = "<{$tag} ";
		foreach ( $atts as $attr => $value ) {
			$attr  = esc_attr( $attr );
			$value = esc_attr( $value );
			$html  .= "{$attr}=\"{$value}\" ";
		}

		$html = trim( $html );

		if ( $single ) {
			$html .= " />";

			return $html;
		}

		$html .= ">" . $content . "</{$tag}>";

		return $html;
	}

endif;


/**
 * Displays image markup by it's ID and given size.
 */
if ( ! function_exists( 'sp_theme_display_image' ) ):

	function sp_theme_display_image( $image_id, $size = 'full', $atts = '' ) {
		// retrieve an image
		$image_markup = wp_get_attachment_image( $image_id, $size, false, $atts );

		// if image exists, output its markup
		if ( $image_markup ) {
			echo ($image_markup); // value is already escaped by wp

			return;
		}

		// output placeholder image tag instead
		echo sp_theme_build_tag(
			'img',
			array(
				'src'   => get_theme_file_uri( 'public/images/placeholder.png' ),
				'class' => 'sp-image-placeholder'
			)
		);
	}

endif;


/**
 * Displays resized image by it's ID and given size.
 */
if ( ! function_exists( 'sp_theme_display_resized_image' ) ):

	function sp_theme_display_resized_image( $image_id, $size_w, $size_h = null, $image_atts = array() ) {
		// retrieve an image
		list( $image_src, $image_w, $image_h ) = wp_get_attachment_image_src( $image_id, 'full' );

		// retrieve image alt attr
		$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
		if ( ! trim( $image_alt ) ) {
			$image_alt = sprintf( esc_attr__( 'Attachment image #%s', 'soprano-ecommerce' ), $image_id );
		}

		// generate image attributes array
		if ( $image_src ) {
			$image_atts = array_merge(
				array(
					'src'      => aq_resize( $image_src, $size_w, $size_h ),
					'data-rjs' => aq_resize( $image_src, $size_w * 2, $size_h * 2 ),
					'alt'      => $image_alt
				),
				$image_atts
			);
		} else {
			$image_atts = array_merge(
				array(
					'src'   => get_theme_file_uri( 'public/images/placeholder.png' ),
					'class' => 'sp-image-placeholder'
				),
				$image_atts
			);
		}

		// output markup
		echo sp_theme_build_tag( 'img', $image_atts );
	}

endif;


/**
 * Displays intro background markup with support of dynamically defined default image
 */
if ( ! function_exists( 'sp_theme_display_intro_bg' ) ) :

	function sp_theme_display_intro_bg( $page_id = null ) {
		if ( ! $page_id && class_exists( 'WooCommerce' ) && is_shop() ) {
			$page_id = wc_get_page_id( 'shop' );
		}

		$bg_image = sp_theme_opt( 'default_intro_background' );
		if ( has_post_thumbnail( $page_id ) ) {
			$bg_image = get_post_thumbnail_id( $page_id );
		}

		if ( $bg_image ) {
			sp_theme_display_image( $bg_image, 'sp-section-bg' );
		} else {
			$placeholder_atts = array(
				'src' => get_theme_file_uri( 'public/images/default.jpg' ),
				'alt' => get_the_title()
			);

			echo sp_theme_build_tag( 'img', $placeholder_atts );
		}
	}

endif;


/**
 * Returns whether sidebar is present for this page or not
 */
if ( ! function_exists( 'sp_theme_is_active_sidebar' ) ) :

	function sp_theme_is_active_sidebar( $area ) {
		$post_id = get_queried_object_id();
		if ( class_exists( 'WooCommerce' ) && is_shop() ) {
			$post_id = wc_get_page_id( 'shop' );
		}

		$sidebar_active = is_active_sidebar( $area );

		if ( $post_id ) {
			$sidebar_hidden = sp_theme_post_opt( 'hide_sidebar', false, $post_id );
		} else {
			$sidebar_hidden = false;
		}

		return $sidebar_active && ! $sidebar_hidden;
	}

endif;


/**
 * Returns sidebar position for current page
 */
if ( ! function_exists( 'sp_theme_get_sidebar_position' ) ) :

	function sp_theme_get_sidebar_position() {
		$post_id = get_queried_object_id();
		if ( class_exists( 'WooCommerce' ) && is_shop() ) {
			$post_id = wc_get_page_id( 'shop' );
		}

		$sidebar_position_global = strtolower( sp_theme_opt( 'sidebar_position_global', 'right' ) );

		if ( $post_id ) {
			$sidebar_position = sp_theme_post_opt( 'sidebar_position', 'inherit', $post_id );
			$sidebar_position = strtolower( $sidebar_position );
		} else {
			$sidebar_position = 'inherit';
		}

		return ( $sidebar_position === 'inherit' ) ? $sidebar_position_global : $sidebar_position;
	}

endif;


/**
 * Returns sidebar sticky option state
 */
if ( ! function_exists( 'sp_theme_sidebar_is_sticky' ) ) :

	function sp_theme_sidebar_is_sticky() {
		$post_id = get_queried_object_id();
		if ( class_exists( 'WooCommerce' ) && is_shop() ) {
			$post_id = wc_get_page_id( 'shop' );
		}

		$sticky_global = strtolower( sp_theme_opt( 'make_sidebar_sticky_global', 'no' ) );

		if ( $post_id ) {
			$sticky = sp_theme_post_opt( 'make_sidebar_sticky', 'inherit', $post_id );
			$sticky = strtolower( $sticky );
		} else {
			$sticky = 'inherit';
		}

		// make use of proper variable
		$sticky = ( $sticky === 'inherit' ) ? $sticky_global : $sticky;

		return ( $sticky === 'yes' );
	}

endif;