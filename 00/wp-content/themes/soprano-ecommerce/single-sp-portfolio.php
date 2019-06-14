<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );
get_header(); the_post(); ?>

<?php /* this file is used to display visual composer pages without any additional markup */ ?>

<div id="sp-wrapper">
	<div class="container"><?php the_content(); ?></div>

	<section class="sp-section little border">
		<?php // get adjacent posts
		$prevPost = get_adjacent_post( false, '', true, 'category' );
		$nextPost = get_adjacent_post( false, '', false, 'category' );

		// get links to posts
		$prevPostLink = ( $prevPost instanceof WP_Post ) ? get_permalink( $prevPost ) : false;
		$nextPostLink = ( $nextPost instanceof WP_Post ) ? get_permalink( $nextPost ) : false; ?>

	    <div class="container">
	        <div class="row">
	            <div class="col-md-4 col-xs-12 sp-portfolio-bar-left <?php if ( ! $prevPostLink ) { echo 'disabled'; } ?>">
	                <a href="<?php echo esc_attr( $prevPostLink ); ?>">
                        <?php esc_html_e('Previous', 'soprano-ecommerce'); ?>
                    </a>
	            </div>
	            <div class="col-md-4 col-xs-12 sp-portfolio-bar-center">
	                <a href="#"><i class="icon-ion-ios-keypad-outline"></i></a>
	            </div>
	            <div class="col-md-4 col-xs-12 sp-portfolio-bar-right <?php if ( ! $nextPostLink ) { echo 'disabled'; } ?>">
	                <a href="<?php echo esc_attr( $nextPostLink ); ?>">
		                <?php esc_html_e('Next', 'soprano-ecommerce'); ?>
                    </a>
	            </div>
	        </div>
	    </div>
	</section>
</div>

<?php get_footer();