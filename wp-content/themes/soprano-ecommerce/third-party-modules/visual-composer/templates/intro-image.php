<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<div class="sp-intro-image-icon">
	<?php if($image_icon !== 'icon'){ ?>
    	<?php sp_theme_display_resized_image( $image, 210 ); ?>
	<?php } else { ?>
		<div class="icon-big"><i class="<?php echo esc_attr( $icon ); ?>"></i></div>
	<?php }; ?>
</div>