<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );
if ( ! have_rows( 'images' ) ) {
	return;
} ?>

<div class="sp-blog-image gallery-format">
    <div class="sp-slick-post-gallery">
		<?php while ( have_rows( 'images' ) ): the_row(); ?>
            <div class="item">
				<?php sp_theme_display_image( get_sub_field( 'image' ), 'large' ); ?>
                <span class="caption"><?php the_sub_field( 'caption' ); ?></span>
            </div>
		<?php endwhile; ?>
    </div>
</div>