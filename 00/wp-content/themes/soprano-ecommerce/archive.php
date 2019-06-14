<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );
get_header(); ?>

<div id="sp-wrapper" class="sp-archive-loop">
    <!-- Page intro -->

	<section class="sp-intro sp-intro-carousel slide-mini-no-title slick-dots-inside slick-initialized slick-slider" style="height:360px;" data-slick="[]">
		<div aria-live="polite" class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 100%;" role="listbox">
		<div class="slider-item slick-slide slick-current slick-active slick-animated" style="height: 350px; width: 100%; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;" 
		data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide00">
		<div class="intro-body">

			
				<div class="intro-title intro-title-3 wow fadeInUp animated" data-wow-duration="1.5s" data-wow-delay="1s" style="visibility: visible; animation-duration: 1.5s; animation-delay: 1s; animation-name: fadeInUp;">Multi-Concept Theme</div>

				<div class="intro-title intro-title-1 wow fadeInUp animated" data-wow-duration="1.5s" data-wow-delay="1.5s" style="visibility: visible; animation-duration: 1.5s; animation-delay: 1.5s; animation-name: fadeInUp;">
					<?php if ( is_archive() || is_search() ) {
						is_archive() && esc_html_e( 'Archive', 'soprano-ecommerce' );
						is_search() && esc_html_e( 'Search results', 'soprano-ecommerce' );
					} else if ( get_queried_object_id() ) {
						echo get_the_title( get_queried_object_id() );
					} else {
						esc_html_e( 'Latest Posts', 'soprano-ecommerce' );
						wp_enqueue_script('header_without_image', get_stylesheet_directory_uri() . '/js/header_without_image.js');
					} ?>
				</div>

				<div class="wow fadeInUp animated" data-wow-duration="1.5s" data-wow-delay="2s" style="visibility: visible; animation-duration: 1.5s; animation-delay: 2s; animation-name: fadeInUp;">
				<a href="#" class="btn btn-primary" tabindex="0"></a></div>

			
		</div>

		<div class="intro-bg re-animate">
		<img width="900" height="497" src="<?php echo get_stylesheet_directory_uri() ?>/img_posts/head-news-bg.jpg" class="attachment-sp-section-bg size-sp-section-bg" />
		</div>
		</div></div></div>
	</section>
	
    <!-- Posts loop -->
    <section class="sp-section cover-news">
        <div class="container" id="sp-blog-inner">
			<?php if ( have_posts() ) {
				$original_id    = get_queried_object_id();
				$listing_layout = strtolower( sp_theme_post_opt( 'listing_layout', 'inherit', $original_id ) );
				$date_post = $_GET['date'];
				$text_search = $_GET['s'];
				if ( $listing_layout === 'inherit' && (!empty($date_post) || !empty($text_search))) {
					$listing_layout = strtolower( sp_theme_opt( 'blog_listing_layout', 'classic' ) );
					get_template_part( 'tpl-blocks', sprintf( 'blog-list-%s', basename( $listing_layout ) ) );
				} else {
					get_template_part( 'tpl-blocks', 'blog-list-masonry');
				}
				
			} else {
				get_template_part( 'tpl-blocks', 'blog-noposts' );
			} ?>
        </div>
    </section>

	
	<div class="container">
		<div class="vc_row wpb_row vc_row-fluid">
			<div class="wpb_column vc_column_container vc_col-sm-12">
				<div class="vc_column-inner ">
					<div class="wpb_wrapper">
						<div class="wpb_text_column wpb_content_element ">
							<div class="wpb_wrapper">
								<div class="insert-page">
								
									<?php 
										$page = get_page_by_title( 'FOOTER-RIOJAWINE' );
										$content = apply_filters('the_content', $page->post_content); 
										echo $content
									?>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <!-- Mailchimp subscription form -->
	<?php //have_posts() && get_template_part( 'tpl-blocks', 'blog-subscribe-block' ); ?>
</div>

<?php get_footer();