<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

//Vista de listado de noticias/posts

?>

<div class="content-column">
	<div id="sp-blog-grid">
	<div class="col-lg-12 col-md-12 col-xs-12 search-form-dates">
		<form role="search" method="get" class="search-form" action="<?php home_url('/'); ?>">
		<?php 
		$text_search = $_GET['s'];
		if(!empty($text_search)){
			?>
				  <input type="hidden" name="s" id="s" value="<?php echo $text_search; ?>"/>
			<?php 
		}
		?>
			  <select name="date" class="dates-posts" onchange="this.form.submit();">
				<option value=""><?php pll_e( 'Ver todo'); ?></option>
				<?php 
				$current_date = "";
				$date_item = "";
				$date_post = $_GET['date'];
				
				global $post;
				
				global $wp_query;
				$original_query = $wp_query;
				
				$args = array( 'posts_per_page' => -1, 'post_status' => 'publish', 'cat' => $original_query->get('cat'));
				
				$myposts = get_posts( $args );
				foreach ( $myposts as $post ) : setup_postdata( $post );
					
				// while ( have_posts() ): the_post(); 
					$date_item = get_the_date("F Y");
					$date_item_param = get_the_date("n_Y");
					
					if($current_date != $date_item) {
					if($date_post == $date_item_param){
					?>
						<option selected value="<?php echo $date_item_param ?>"><?php echo $date_item; ?></option>
					<?php 
					} else {
					?>
						<option value="<?php echo $date_item_param ?>"><?php echo $date_item; ?></option>
					<?php 
					}
					$current_date = $date_item;
					}
				// endwhile;
				endforeach; ?>
				
				<?php //wp_reset_postdata(); ?>
				<?php //wp_reset_query();?>
			  </select>
		</form>
	</div>
		<?php if ( sp_theme_is_active_sidebar( 'sp-main-sidebar' ) ) {
			$post_col_classes = 'col-lg-6 col-md-12 col-xs-12';
		} else {
			$post_col_classes = 'col-lg-4 col-md-6 col-xs-12';
        }

		$current_date = "";
		$date_item = "";
		$i = 0;
		
		// global $post;
		global $wp_query;
		$original_query = $wp_query;
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

		// $args = array( 'posts_per_page' => 10, 'post_status' => 'publish', 'paged' => $paged);
			
		$original_query->set('posts_per_page', 10);
		$original_query->set('paged', $paged);
		
        $date_post = $_GET['date'];
        $text_search = $_GET['s'];
		
		if(!empty($date_post)){
			$array_date = explode('_',$date_post);

			$monthnum = $array_date[0];
			$year = $array_date[1];
		}
		
		
		if(!empty($year) && !empty($monthnum)){
			$original_query->set('year', $year);
			$original_query->set('monthnum', $monthnum);
			$original_query->set('posts_per_page', -1);
			$original_query->set('paged', 1);
			// $args = array( 'posts_per_page' => -1, 'post_status' => 'publish', 'year' => $year, 'monthnum' => $monthnum);
		}		
		
		if(!empty($text_search)){
			$original_query->set('s', $text_search);
			$original_query->set('posts_per_page', -1);
			$original_query->set('paged', 1);
			// $args = array( 'posts_per_page' => -1, 'post_status' => 'publish', 's' => $text_search);
		}
		
		
		if(!empty($year) && !empty($monthnum) && !empty($text_search)){
			$original_query->set('year', $year);
			$original_query->set('monthnum', $monthnum);
			$original_query->set('s', $text_search);
			$original_query->set('posts_per_page', -1);
			$original_query->set('paged', 1);
			// $args = array( 'posts_per_page' => -1, 'post_status' => 'publish', 'year' => $year, 'monthnum' => $monthnum, 's' => $text_search);
		}		
		
		
		// $myposts = get_posts( $args );
		// foreach ( $myposts as $post ) : setup_postdata( $post );
		while ( have_posts() ): the_post(); 
			$date_item = get_the_date("F Y");
			
			if($current_date != $date_item) {
				if($current_date != "" && $post_item_class != "item-primary"){
					?>
					</div>
					<?php
				}
				$post_item_class = "item-primary";
				$i = 0;
				$current_date = $date_item;
				?>
				<div class="col-lg-12 col-md-12 col-xs-12">
				<p class="date-group"><?php echo $current_date; ?></p>
				</div>
				<div class="col-lg-12 col-md-12 col-xs-12 post-item-large">
				<?php
			}else{
				$post_item_class = "item-second";
				if($i == 0){
					?>
					<div class="container-post-mini col-lg-12 col-md-12 col-xs-12">
						<div class="col-lg-6 col-md-12 col-xs-12 post-item-mini left">
					<?php
					$i = $i + 1;
				}  elseif($i == 1){
					?>
					<div class="col-lg-6 col-md-12 col-xs-12 post-item-mini right">
					<?php
					$i = $i + 1;
				}  elseif($i == 2){
					$i = 1;
					?>
					</div>
					<div class="container-post-mini col-lg-12 col-md-12 col-xs-12">
						<div class="col-lg-6 col-md-12 col-xs-12 post-item-mini left">
					<?php
				}
				
			}?>
			
			
				<article <?php post_class( 'sp-blog-block masonry' ); ?>>
					<div class="<?php echo esc_attr( $post_item_class ); ?>">
						<div class="container_image">
						<?php if ( has_post_thumbnail() ){ ?>
							<?php sp_theme_display_image( get_post_thumbnail_id(), 'sp-blog-preview' );?>
						<?php } else {
							
							$winery_placeholder = get_stylesheet_directory_uri() . '/img_bodegas/imagenes-bodega/bodega.jpg';?>
							<img src="<?php echo $winery_placeholder ?>" />
						<?php } ?>
							<div class="velo-magenta-noticias-rioja show-overlay"></div>
							<div class="capa_negra"></div>
						</div>
						
						<div class="post-item-contain">
							<p class="uc_classic_carousel_date">
								<span class="category_post"><?php sp_theme_get_primary_category(); ?></span>
								<span class="date-post"><?php echo get_the_date("d M Y"); ?></span>
							</p>
							<h3 class="entry-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
						</div>
					</div>
				</article>
			</div>
			
		<?php 
		endwhile;
		// endforeach;
			if($i == 1 || $i == 2){?>
				</div>
		<?php } ?>
		
		<?php wp_reset_postdata(); ?>
		<?php wp_reset_query();?>
	</div>

    <?php 
	if(empty($date_post) && empty($text_search))
		sp_theme_display_posts_pagination(); ?>
</div>

<?php get_template_part( 'tpl-blocks', 'sidebar-area' ); ?>