<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

if ( get_post_type() !== 'post' ) { // this feature works only with posts
	return;
}

$loop = sp_theme_related_posts_function();
if ( ! $loop->have_posts() || $loop->post_count < 2 ) {
	return;
} ?>

<div class="sp-section little pb0 sp-related-posts">
    <h3 class="block-title"><?php esc_html_e( 'Related Posts', 'soprano-ecommerce' ); ?></h3>

    <div class="sp-slick-related">
        <?php while ( $loop->have_posts() ): $loop->the_post(); ?>
            <div <?php post_class('item') ?>>
                <a class="sp-blog-image" href="<?php the_permalink(); ?>">
                    <?php sp_theme_display_image( get_post_thumbnail_id(), 'sp-blog-preview' ); ?>
                </a>
                <h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <div class="sp-blog-meta">
                    <ul>
                        <li><?php echo get_the_date(); ?></li>
                        <li><?php sp_theme_get_primary_category(); ?></li>
	                    <?php if ( function_exists( 'the_views' ) ): ?>
                            <li class="text-lowercase"><?php the_views(); ?></li>
	                    <?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</div>