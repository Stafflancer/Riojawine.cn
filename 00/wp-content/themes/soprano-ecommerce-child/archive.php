<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );
get_header();


if ( get_locale() == 'es_ES'){
    $locale = "Locale: es\r\n";
}

 ?>

<div id="sp-wrapper" class="sp-archive-loop">
    <!-- Page intro -->

	<?php
	wp_enqueue_script('header_without_image', get_stylesheet_directory_uri() . '/js/header_without_image.js');
	?>
	
	
    <!-- Posts loop -->
    <section class="sp-section cover-news">
        <div class="container" id="sp-blog-inner">
			<?php if ( have_posts() ) {
				$original_id    = get_queried_object_id();
				$listing_layout = strtolower( sp_theme_post_opt( 'listing_layout', 'inherit', $original_id ) );
				// $date_post = $_GET['date'];
				$text_search = $_GET['s'];
				if ( $listing_layout === 'inherit' && (/*!empty($date_post) || */!empty($text_search))) {
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
										if ( $locale == 'es_ES'){
											$page = get_page_by_title( 'FOOTER-RIOJAWINE' );
										} else {
											$page = get_page_by_title( 'FOOTER-RIOJAWINE EN' );
										}
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