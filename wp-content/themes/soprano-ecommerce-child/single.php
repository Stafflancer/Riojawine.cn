<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );
get_header(); the_post(); ?>

<div id="sp-wrapper" <?php post_class('sp-single-post-page'); ?>>
	<?php 
					
		global $post;
		$postcat = get_the_category( $post->ID );

		if ( ! empty( $postcat ) ) {
			$name_cat = $postcat[0]->name;
			$id_cat = get_cat_ID(esc_html( $name_cat ));
		}

		// Get the URL of this category
		$category_link = get_category_link( $id_cat );
	?>

	<!-- Page container -->
	<section class="sp-section post-section">
		<div class="container" id="sp-page-inner">
		
			<div class="content-column">
                <!-- Post content -->
				<div class="sp-blog-block single">
                    <div class="entry-content">
						<div class="vc_column-inner ">
							<div class = "wpb_wrapper">
								<ol class="wwp-vc-breadcrumbs">
									<li class="visited"><a href="/"><?php esc_html_e( 'Home', 'soprano-ecommerce' ); ?></a></li>
									<li class="visited"><?php sp_theme_get_primary_category(); ?></li>
									<li class="current"><span><?php the_title(); ?></span></li>
								</ol>
							</div>
						</div> 
						
						
						<?php 
						$post_format = get_post_format();
						if ( $post_format === 'audio' || $post_format === 'video'  || (strtolower($name_cat) === 'rioja wine tv') ) {
							$post_format = str_replace( array( 'audio', 'video' ), 'oembed', $post_format );
							
							get_template_part( 'tpl-blocks', sprintf( 'blog-header-%s', $post_format ) );
							
						?>
							

							<div class="vc_column-inner category-date-post">
								<div class = "wpb_wrapper">
									<div class = "container_links">
										<div class = "container_link_category">
											<span class="category_post"><?php sp_theme_get_primary_category(); ?></span>
											<span class="date-post"><?php echo get_the_date("d M Y"); ?></span>
										</div>
								
										
										<div class = "container_social_buttons">
									
											<span>Comparte este vídeo</span>
											<a href="javascript: void(0);" data-layout="button" 
											onclick="window.open('http://service.weibo.com/staticjs/weiboshare.html?url=<?php the_title(); ?> - <?php the_permalink(); ?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');">
												<i class="fa fa-weibo"></i>
											</a>
                                            /***********/
											
											<a href="javascript: void(0);" data-layout="button" 
											onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;title=<?php the_title(); ?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');">
												<i class="fa fa-facebook-f"></i> 
											</a>
										</div>
										
									</div>
								</div>
							</div>						
							
							<div class="vc_column-inner ">
								<div class = "wpb_wrapper">
									<h1 class="post-title"><?php the_title(); ?></h1>
									<!--<h4 class="post-short-text"><?php //the_excerpt(); ?></h4>-->
								</div>
							</div>
						
						<?php } else{ ?>
						
							<div class="vc_column-inner ">
								<div class = "wpb_wrapper">
									<h1 class="post-title"><?php the_title(); ?></h1>
									<!--<h4 class="post-short-text"><?php //the_excerpt(); ?></h4>-->
								</div>
							</div>

							<div class="vc_column-inner category-date-post">
								<div class = "wpb_wrapper">
									<div class = "container_links">
										<div class = "container_link_category">
											<span class="category_post"><?php sp_theme_get_primary_category(); ?></span>
											<span class="date-post"><?php echo get_the_date("d M Y"); ?></span>
										</div>
								
										
										<div class = "container_social_buttons">
										<?php if (strtolower($name_cat) === 'eventos') {?>
											<span>Comparte este evento</span>
										<?php } else { ?>
											<span>Comparte esta noticia</span>
										<?php } ?>
											<a href="javascript: void(0);" data-layout="button" 
											onclick="window.open('http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');">
												<i class="fa fa-twitter"></i>
											</a>
											
											<a href="javascript: void(0);" data-layout="button" 
											onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;title=<?php the_title(); ?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');">
												<i class="fa fa-facebook-f"></i> 
											</a>
											<a href="javascript:window.print()"><i class="fa fa-print"></i></a>
										</div>
										
									</div>
								</div>
							</div>
						<?php } ?>
						
							
						
						
                        <div class="clearfix"><?php the_content(); ?></div>
                        <div class="clearfix"><?php wp_link_pages(); ?></div>
                    </div>

					<?php 
					
						// global $post;
						// $postcat = get_the_category( $post->ID );

						// if ( ! empty( $postcat ) ) {
							// $name_cat = $postcat[0]->name;
							// $id_cat = get_cat_ID(esc_html( $name_cat ));
						// }
 
						// Get the URL of this category
						// $category_link = get_category_link( $id_cat );
					?>
					<div class = "container_links">
						<div class = "container_link_category">
							<span class="return_category"><i class="fa fa-chevron-left"></i> <a href ="<?php echo $category_link; ?>">Volver a "<?php echo $name_cat; ?>"</a></span>
						</div>
						<?php 
							$post_format = get_post_format();
							if ( $post_format !== 'audio' && $post_format !== 'video' && (strtolower($name_cat) !== 'rioja wine tv')) {?>
								<div class = "container_social_buttons">
									<?php if (strtolower($name_cat) === 'eventos') {?>
										<span>Comparte este evento</span>
									<?php } else { ?>
										<span>Comparte esta noticia</span>
									<?php } ?>
									<a href="javascript: void(0);" data-layout="button" 
									onclick="window.open('http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');">
										<i class="fa fa-twitter"></i>
									</a>
									
									<a href="javascript: void(0);" data-layout="button" 
									onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;title=<?php the_title(); ?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');">
										<i class="fa fa-facebook-f"></i> 
									</a>
									<a href="javascript:window.print()"><i class="fa fa-print"></i></a>
								</div>
						<?php } ?>
						
					</div>
					
					
                    <!-- Post tags -->
					<?php //if ( ! post_password_required() ) {
						//the_tags( '<div class="sp-single-tags">', ' ', '</div>' );
					//} ?>
				</div>

				<!-- Related posts -->
				<?php //if ( ! post_password_required() ) {
					//get_template_part( 'tpl-blocks', 'blog-related-posts' );
				//} ?>

				<!-- Comments -->
                <?php //comments_template(); ?>
			</div>

			<?php if ( ! post_password_required() ) {
				get_template_part( 'tpl-blocks', 'sidebar-area' );
			} ?>
		</div>
	</section>
	<?php
		
		// global $post;
		// $postcat = get_the_category( $post->ID );

		// if ( ! empty( $postcat ) ) {
			// $id_cat = get_cat_ID(esc_html( $postcat[0]->name ));
		// }
		

		$myposts = get_posts( array(
			'offset'         => 1,
			'orderby'		 => 'date',
			'category'       => $id_cat
		) );
		if ( $myposts ) {
			?>
	<div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid post-carousel-container">
	
		<div class="wpb_column vc_column_container vc_col-sm-12">
			<div class="vc_column-inner ">
				<div class="container">
					<div class="vc_row wpb_row vc_row-fluid">
						<div class="wpb_column vc_column_container vc_col-sm-12">
							<div class="vc_column-inner "> 
								<div class="wpb_wrapper">
								<?php 
								$post_format = get_post_format();
								if ( $post_format === 'audio' || $post_format === 'video' || (strtolower($name_cat) === 'rioja wine tv') ) {									
								?>
									<h2 class="title_carousel mini">RIOJA WINE TV</h2>
									<h1 class="title_carousel">Últimos vídeos</h2>
								<?php } else { ?>
								
									<?php if (strtolower($name_cat) === 'eventos') {?>
										<h2 class="title_carousel mini">RIOJA EVENTOS</h2>
										<h1 class="title_carousel">Últimos eventos</h2>
									<?php } else { ?>
										<h2 class="title_carousel mini">RIOJA NOTICIAS</h2>
										<h1 class="title_carousel">Últimas noticias</h2>
									<?php } ?>
								<?php } ?>
									<div class="container_carousel">
										<i class="prev-page fa fa-chevron-left"></i>
											<div class="uc_classic_carousel">
												<div class="uc_carousel owl-carousel owl-theme owl-loaded owl-text-select-on">
													
															<?php
															
																foreach ( $myposts as $post ) : 
																	setup_postdata( $post ); 
																	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
																	?>
																	
																	
																	<div class="owl-item">
																		<div class="uc_classic_carousel_container_holder">
																			<div class="uc_classic_carousel_container_data">
																				<div class="uc_classic_carousel_placeholder">
																					<div class="container_image">
																						<img src="<?php echo $url;?>" alt="">
																						<div class="velo-magenta-noticias-rioja show-overlay"></div>
																						<div class="capa_negra"></div>
																					</div>
																				</div>
																				<div class="uc_classic_carousel_content">
																					<p class="uc_classic_carousel_date">
																						<span class="category_post"><?php sp_theme_get_primary_category(); ?></span>
																						<span class="date-post"><?php echo get_the_date("d M Y"); ?></span>
																					</p>
																					<a class="uc_more_btn" href="<?php the_permalink(); ?>">
																						<h4 class="uc_classic_carousel_title"><?php the_title(); ?></h4>
																					</a>
																				</div>
																			</div>
																		</div>
																	</div>
																	
															<?php
																endforeach;
															?>
														
												</div>
											</div>
										
										<i class="next-page fa fa-chevron-right"></i>
									</div>		
								</div>
							 </div>
						</div>
					</div>
				</div> 
			</div>
		</div>
	</div>
	<?php
		wp_reset_postdata();
		}
	?>
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
	
	
	
</div>
<?php get_footer();