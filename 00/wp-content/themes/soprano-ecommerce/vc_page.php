<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );
get_header(); the_post(); ?>

<?php /* this file is used to display visual composer pages without any additional markup */ ?>

<div id="sp-wrapper">
	<div class="container"><?php the_content(); ?></div>
</div>

<?php get_footer();