<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


class SopranoTheme_MostViewed_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
			'sp_theme_most_viewed_posts',

			// Widget name will appear in UI
			esc_attr__( 'Popular posts', 'soprano-ecommerce' ),

			// Widget description
			array( 'description' => esc_attr__( 'Displays most popular posts of your blog based on views count. Works only when WP-PostViews plugin is installed.', 'soprano-ecommerce' ) )
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$instance = $this->parse_instance( $instance );
		$title    = apply_filters( 'widget_title', $instance['title'] );

		$most_viewed = new WP_Query( array(
			'post_type'           => 'post',
			'posts_per_page'      => $instance['post_count'],
			'ignore_sticky_posts' => true,
			'orderby'             => 'meta_value_num',
			'order'               => 'desc',
			'meta_key'            => 'views',
		) );

		// hide widget if there is no any posts
		if ( ! $most_viewed->have_posts() ) {
			return;
		}

		// before and after widget arguments are defined by themes
		echo( $args['before_widget'] );
		if ( ! empty( $title ) ) {
			printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] );
		} ?>

        <ul class="sp-popular-posts">
			<?php while ( $most_viewed->have_posts() ):
				$most_viewed->the_post();
				$post_views = intval( get_post_meta( get_the_ID(), 'views', true ) );
				$crop_title = trim( trim( substr( get_the_title(), 0, 35 ) ), '.,;?!' ); ?>
                <li>
                    <a href="<?php the_permalink(); ?>" class="post-link">
						<?php if ( has_post_thumbnail() ): ?>
                            <div class="image"><?php echo wp_get_attachment_image( get_post_thumbnail_id() ); ?></div>
						<?php endif; ?>

                        <div class="content">
                            <h5><?php echo ( strlen( get_the_title() ) > 35 ) ? $crop_title . '...' : $crop_title; ?></h5>
                            <span><?php printf( esc_html__( '%d view(s)', 'soprano-ecommerce' ), $post_views ); ?></span>
                        </div>
                    </a>
                </li>
			<?php endwhile; ?>
        </ul>

		<?php echo( $args['after_widget'] );
		wp_reset_postdata();
	}

	// Widget Backend
	public function form( $instance ) {
		$instance = $this->parse_instance( $instance ); ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title:', 'soprano-ecommerce' ); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $instance['title'] ); ?>"/>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'post_count' ) ); ?>">
				<?php esc_html_e( 'Post count:', 'soprano-ecommerce' ); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_count' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'post_count' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $instance['post_count'] ); ?>"/>
        </p>
		<?php
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = $this->parse_instance( $old_instance );
		$instance = array_merge( $instance, $new_instance );

		return $instance;
	}

	// Parse instance and fill default values
	private function parse_instance( $instance ) {
		return wp_parse_args(
			$instance,
			array(
				'title'      => null,
				'post_count' => 3
			)
		);
	}
}


/**
 * Register this widget only if WP-PostViews plugin is installed and active
 */
if ( is_plugin_active( 'wp-postviews/wp-postviews.php' ) ) {
	unregister_widget( 'WP_Widget_PostViews' );
	register_widget( 'SopranoTheme_MostViewed_Widget' );
}