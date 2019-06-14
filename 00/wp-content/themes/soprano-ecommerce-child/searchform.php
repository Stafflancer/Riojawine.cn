<form role="search" method="get" class="search-form" action="<?php echo site_url();//home_url('/'); ?>">
	<?php 
		$date_post = $_GET['date'];
		if(!empty($date_post)){
			?>
				  <input type="hidden" name="date" value="<?php echo $date_post; ?>"/>
			<?php 
		}
	?>
  <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( pll_e('Buscar en Noticias'), 'placeholder' ) ?>" 
  value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    
  <button class="search-submit" type="submit"><i class="fa fa-search"></i></button>
</form>