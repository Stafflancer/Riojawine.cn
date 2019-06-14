<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );
$oembed_code = sp_theme_post_opt( 'oembed' );
if ( ! $oembed_code ) {
	return;
} ?>

<div class="embed-responsive embed-responsive-16by9 sp-single-embed"><?php echo ($oembed_code); ?></div>