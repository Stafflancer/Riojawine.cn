<?php
		
	$text_search = $_GET['term'];//$wp_query->query_vars['term'];
				
				
    if ( get_locale() == 'es_ES'){
        $locale = "Locale: es\r\n";
    }

	global $post;  // required

	$not_pages = array( 93, 153, 155, 164, 369, 722, 852, 980, 1241, 2149, 8599, 8901 );//NO MOSTRAR HOMES Y PÁGINA DE MÓDULOS, MAINTENANCE MODE, BUSCADORES, FOOTER, FICHA MUNICIPIO, FICHA BODEGA, FICHA VINO, FICHA ESPACIOS CULTURALES
    if( isset( $text_search ) && !empty( $text_search) ){ ?>
		<div class="row title-last-news">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h3><?php echo pll_e("Encuentra lo que buscas")?></h3>
			</div>
		</div>
        <div class="row title-last-news">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <p><?php echo pll_e("Resultados de la búsqueda del término")?> "<strong><?php echo esc_html(strtolower($text_search)); ?></strong>"</p>
            </div>
        </div>
	<?php
		$args = array('post_type' => array('post','page'), 
				's'=> $text_search, 
				'paged' => 1, 
				'posts_per_page' => -1, 
				'post_status' => 'publish', 
				'post__not_in' => $not_pages, 
				// 'post_parent__not_in ' => array( 253 ),  //NO MOSTRAR LAS PÁGINAS HIJAS DE NORMATIVAS
				'orderby' => 'relevance', 
				'order' => 'ASC');

	} else {
		//MOSTRAR ÚLTIMOS 10 POSTS
		$args = array('post_type' => array('post'),
				'paged' => 1, 
				'posts_per_page' => 10, 
				'post_status' => 'publish', 
				// 'post_parent__not_in ' => array( 253 ),  //NO MOSTRAR LAS PÁGINAS HIJAS DE NORMATIVAS
				'orderby' => 'date', 
				'order' => 'DESC');
		?>
		<div class="row title-last-news">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h3><?php echo pll_e("Lo último en Riojawine")?></h3>
			</div>
		</div>
		<?php
	}?>
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<?php 

				$custom_posts = get_posts($args);
				?>
				<ul class="general_search_results">
				<?php
					foreach($custom_posts as $post) : setup_postdata($post);
						?>
							<li>
								<p class="uc_classic_carousel_date">
									<?php 
										$category = get_the_category( $post->ID ); 
										if( isset( $category ) && !empty( $category) ){ 
										?>
										<span class="category_post"><?php echo $category[0]->name; ?></span>
										<span class="date-post"><?php echo get_the_date("d M Y"); ?></span>
										<?php 
										} else {
										?>
										<span class="category_post"><?php echo pll_e("PÁGINA")?></span>
										<?php 
										}
									?>
									
								</p>
								<a href="<?php the_permalink(); ?>">
									<h5>
										<?php the_title(); ?>

									</h5>
								
									<span class="general_search_text">
									<?php 
										$content_post = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $post->post_content);
										$content_post = html_entity_decode(strip_tags(strip_shortcodes($content_post)));
										$pos_text_search = stripos($content_post, $text_search);
										
										if( isset( $pos_text_search ) && !empty( $pos_text_search)){
											if($pos_text_search > 50)
												$pos_text_search = $pos_text_search - 50;
											
											$text_to_show = str_ireplace($text_search, '<strong>'. strtolower($text_search) . '</strong>', substr(strip_shortcodes($content_post), $pos_text_search, 200));
											
											echo '...' . $text_to_show . '...';
										}
									?>
									</span>
									
								</a>
							</li>
						<?php 
					
					endforeach;
				
				?>
				</ul>
				
			</div>
		</div>
	<?php 
	
	wp_reset_postdata();
	?>
	
	<script>
	jQuery(document).ready( function(){
		jQuery('#general-search').val('<?php echo $text_search; ?>');
	});
	</script>
    
