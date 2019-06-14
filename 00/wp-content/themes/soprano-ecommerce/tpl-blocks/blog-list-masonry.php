<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

//Vista de listado de noticias/posts

?>

<div class="content-column">
	<div id="sp-blog-grid">
	<div class="col-lg-12 col-md-12 col-xs-12 search-form-dates">
		<form role="search" method="get" class="search-form" action="<?php echo site_url(); ?>">
			<input type="hidden" name="s" id="s" />
			  <select name="date" class="dates-posts" onchange="this.form.submit();">
				<option value=""><?php esc_html_e( 'Ver todo', 'soprano-ecommerce' ); ?></option>
				<?php 
				$current_date = "";
				$date_item = "";
				while ( have_posts() ): the_post(); 
					$date_item = get_the_date("F Y");
					$date_item_param = get_the_date("n-Y");
					$date_post = $_GET['date'];
					
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
				endwhile; ?>
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
					<?php
					$i = $i + 1;
				} elseif($i == 2){
					$i = 0;
					?>
					</div>
					<div class="container-post-mini col-lg-12 col-md-12 col-xs-12">
					<?php
				}
				?>
				<div class="col-lg-6 col-md-12 col-xs-12 post-item-mini">
				<?php
				
			}?>
			
			
				<article <?php post_class( 'sp-blog-block masonry' ); ?>>
					<div class="<?php echo esc_attr( $post_item_class ); ?>">
						<?php if ( has_post_thumbnail() ): ?>
						<div class="container_image">
							<?php sp_theme_display_image( get_post_thumbnail_id(), 'sp-blog-preview' );?>
							<div class="capa_negra"></div>
						</div>
						
						<?php endif; ?>
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
			
		<?php endwhile; ?>
	</div>

    <?php sp_theme_display_posts_pagination(); ?>
</div>

<?php get_template_part( 'tpl-blocks', 'sidebar-area' ); ?>