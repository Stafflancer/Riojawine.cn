<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );
get_header(); the_post(); ?>

<div id="sp-wrapper" <?php post_class('sp-static-page'); ?>>
	<!-- Page intro -->
    <section class="sp-intro sp-intro-image">
        <div class="intro-bg"><?php sp_theme_display_intro_bg(); ?></div>

        <div class="intro-body">
            <div class="intro-title intro-title-1 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
                <?php the_title(); ?>
            </div>
        </div>
    </section>

	<!-- Page content & pagination -->
    <section class="sp-section">
        <div class="container" id="sp-page-inner">
            <div class="content-column">
                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php wp_link_pages(); ?>
                </div>

	            <?php ( comments_open() || get_comments_number() ) && comments_template(); ?>
            </div>

	        <?php if ( ! post_password_required() ) {
		        get_template_part( 'tpl-blocks', 'sidebar-area' );
	        } ?>
        </div>
    </section>
</div>

<?php get_footer();