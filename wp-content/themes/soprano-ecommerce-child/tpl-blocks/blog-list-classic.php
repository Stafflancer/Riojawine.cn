<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

 //Vista de resultados de buscador

?>

<div class="content-column">
	<div id="sp-blog-grid">

		<?php 
		
			$i = 0;
			while ( have_posts() ): the_post(); 
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
				?>
				
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
		
		<?php endwhile; 
			if($i == 1 || $i == 2){?>
				</div>
		<?php } ?>
	</div>
		
	<?php wp_reset_postdata(); ?>
	<?php wp_reset_query();?>

    <?php sp_theme_display_posts_pagination(); ?>
</div>

<?php get_template_part( 'tpl-blocks', 'sidebar-area' ); ?>

