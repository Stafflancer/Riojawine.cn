<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/**
 * @var $posts_query WP_Query
 * @var $el_class string
 */

if ( ! $posts_query->have_posts() ) {
	return;
} ?>

<div class="sp-latest-news-widget <?php echo esc_attr( $el_class ) ?>">
	<?php while ( $posts_query->have_posts() ): $posts_query->the_post(); ?>
		<div class="post-item-wrapper">
			<article <?php post_class( 'sp-blog-block masonry' ); ?>>
				<?php if ( has_post_thumbnail() ): ?>
					<div class="sp-blog-image">
						<a href="<?php the_permalink(); ?>"><?php
							sp_theme_display_image( get_post_thumbnail_id(), 'sp-blog-preview' );
						?></a>
					</div>
				<?php endif; ?>

				<h3 class="entry-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>

				<div class="sp-blog-meta">
					<ul>
						<li><?php the_author_link() ?></li>
						<li><?php sp_theme_get_primary_category(); ?></li>
						<?php if ( function_exists( 'the_views' ) ): ?>
							<li class="text-lowercase"><?php the_views(); ?></li>
						<?php endif; ?>
					</ul>
				</div>

				<div class="entry-excerpt"><?php echo sp_theme_get_cropped_post_excerpt( 120 ); ?></div>

				<div class="sp-blog-read">
					<a href="<?php the_permalink(); ?>" class="btn btn-sm btn-primary">
						<?php esc_html_e( 'Read More', 'soprano-ecommerce' ) ?>
					</a>
				</div>
			</article>
		</div>
	<?php endwhile; wp_reset_postdata(); ?>
</div>