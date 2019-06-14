<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<?php $intro_atts = array(
	'class' => 'sp-intro ' . esc_attr( $el_class ),
	'style' => ( $height ) ? sprintf( 'height:%s', esc_attr( $height ) ) : false
); ?>

<section <?php echo html_build_attributes( $intro_atts ); ?>>
	<?php if ( $bg_type === 'image' ): ?>
        <div class="intro-bg re-animate"><?php
            sp_theme_display_image( $bg_image, 'sp-section-bg' );
        ?></div>
	<?php endif; ?>

	<?php if ( $bg_type === 'video' ): ?>
        <?php $video_atts = array(
		    'class'      => 'video-container',
		    'data-url'   => $youtube_url,
		    'data-start' => ( is_numeric( $video_start ) && $video_start > 0 ) ? $video_start : false,
		    'data-stop'  => ( is_numeric( $video_end ) && $video_end > 0 ) ? $video_end : false
	    ); ?>
        <div <?php echo html_build_attributes( $video_atts ); ?>>
			<?php sp_theme_display_image(
                $video_placeholder_image,
                'sp-section-bg',
                array( 'class' => 'video-placeholder' )
            ); ?>

            <div class="video-controls">
                <a href="#" class="sp-video-play" title="<?php esc_attr_e( 'Play/pause', 'soprano-ecommerce' ); ?>">
                    <i class="icon-ion-ios-pause"></i>
                </a>

                <a href="#" class="sp-video-volume" title="<?php esc_attr_e( 'Mute/unmute', 'soprano-ecommerce' ); ?>">
                    <i class="icon-ion-android-volume-down"></i>
                </a>
            </div>
        </div>
	<?php endif; ?>

	<?php if ( $add_dotted_pattern === 'yes' ): ?>
        <div class="intro-dotted-bg"></div>
    <?php endif; ?>

    <div class="intro-body"><?php echo do_shortcode( $content ); ?></div>
</section>