<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

 //Vista de resultados de buscador cuando no hay nada

?>

<div class="content-column no-results">
	<span class="text-no-results"><?php pll_e( 'Sorry, Nothing Found'); ?></span>

    <?php sp_theme_display_posts_pagination(); ?>
</div>

<?php get_template_part( 'tpl-blocks', 'sidebar-area' ); ?>

