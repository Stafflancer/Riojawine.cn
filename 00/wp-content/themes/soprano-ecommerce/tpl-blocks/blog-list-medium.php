<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/**
 * This file represents medium-style blogroll listing layout
 */

?>

<div class="content-column">
	<?php while ( have_posts() ): the_post(); ?>
		<article <?php post_class( 'sp-blog-block medium' ); ?>>
			<?php if ( has_post_thumbnail() ): ?>
				<a href="<?php the_permalink(); ?>" class="sp-blog-image"><?php
					sp_theme_display_image( get_post_thumbnail_id(), 'sp-blog-preview' );
				?></a>
			<?php endif; ?>

			<div class="sp-blog-block-medium">
				<h3 class="entry-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>

				<div class="sp-blog-meta">
					<ul>
						<li class="hidden-xl-up"><?php echo get_the_date(); ?></li>
						<li><?php the_author_link() ?></li>
						<li><?php sp_theme_get_primary_category(); ?></li>
						<?php if ( function_exists( 'the_views' ) ): ?>
                            <li class="text-lowercase"><?php the_views(); ?></li>
						<?php endif; ?>
					</ul>
				</div>

				<div class="entry-excerpt"><?php echo sp_theme_get_cropped_post_excerpt(200); ?></div>

				<div class="sp-blog-read">
					<a href="<?php the_permalink(); ?>" class="btn btn-sm btn-primary">
						<?php esc_html_e( 'Read More', 'soprano-ecommerce' ) ?>
					</a>
				</div>
			</div>
		</article>
	<?php endwhile; ?>

	<?php sp_theme_display_posts_pagination(); ?>
</div>

<?php get_template_part( 'tpl-blocks', 'sidebar-area' ); ?>