<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<?php $intro_atts = array(
	'class'      => 'sp-intro sp-intro-carousel ' . esc_attr( $el_class ),
	'data-slick' => json_encode( $slick_options ),
); ?>

<section <?php echo html_build_attributes( $intro_atts ); ?>>
	<?php foreach ( $slides as $slide ): ?>
        <?php $slide_atts = array(
		    'class' => 'slider-item',
		    'style' => ( $slider_height ) ? sprintf( 'height:%s', esc_attr( $slider_height ) ) : false,
	    ); ?>
        <div <?php echo html_build_attributes( $slide_atts ) ?>>
			<div class="intro-body">

		        <?php if($slide['layout'] === 'standard') { ?>

		            <div class="intro-title intro-title-3 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1s"><?php echo wp_kses_post( $slide['s_subtitle'] ); ?></div>

		            <div class="intro-title intro-title-1 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1.5s"><h1><?php echo wp_kses_post( $slide['s_title'] ); ?></h1></div>

		            <div class="wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="2s"><a href="<?php echo esc_url( $slide['s_link'] ); ?>" class="btn btn-primary"><?php echo wp_kses_post( $slide['s_button'] ); ?></a></div>

				<?php } elseif ($slide['layout'] === 'text')  { ?>

		            <div class="intro-title intro-title-1 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="1s"><h1><?php echo wp_kses_post( $slide['t_title'] ); ?></h1></div>

		            <p class="wow fadeIn" data-wow-duration="1.5s" data-wow-delay="1.5s"><?php echo wp_kses_post( $slide['t_text'] ); ?></p>

		            <div class="wow fadeInUp sp-marg50" data-wow-duration="1.5s" data-wow-delay="1s"><a href="<?php echo esc_url( $slide['t_link'] ); ?>" class="btn btn-primary"><?php echo wp_kses_post( $slide['t_button'] ); ?></a></div>

		            <?php if ($slide['t_arrow'] == true) { ?><a class="sp-scroll-down-cta hidden-xs-down wow fadeIn" href="#sp-about" data-wow-duration="1.5s" data-wow-delay="2s"><span><i class="icon-ion-ios-arrow-thin-down"></i></span></a><?php }; ?>

		        <?php } elseif ($slide['layout'] === 'video')  { ?>
					<div class="intro-title intro-title-1 wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay="1.5s"><h1><?php echo wp_kses_post( $slide['v_title'] ); ?></h1></div>

					<!--<h4 class="intro-title intro-title-3 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="1.5s"><?php echo wp_kses_post( $slide['v_subtitle'] ); ?></h4>-->
					<p class="wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="1.5s"><?php echo wp_kses_post( $slide['v_subtitle'] ); ?></p>

					<p class="wow fadeInUp swipebox-video-p" data-wow-duration="1.5s" data-wow-delay="2s">
						
							<div class="wow fadeInDown link-container" data-wow-duration="1.5s" data-wow-delay="1.5s">
							<!--<i class="far fa-play-circle"></i>-->
							<a class="link-white" href="<?php echo esc_url( $slide['v_video'] ); ?>" data-rel="video" class="swipebox-video" target="_blank"><span><?php esc_html_e( 'Mira el vídeo completo', 'soprano-ecommerce' )?><span></a>
							</div>
						
					</p>


		        <?php } elseif ($slide['layout'] === 'buttons')  { ?>

		            <div class="intro-title intro-title-1 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="1s"><h1><?php echo wp_kses_post( $slide['b_title'] ); ?></h1></div>

		            <div class="intro-title intro-title-3 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="1.5s"><?php echo wp_kses_post( $slide['b_subtitle'] ); ?></div>

					<ul class="list-inline intro">

						<li><a href="<?php echo esc_url( $slide['b_url_one'] ); ?>" class="btn btn-border wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay="2s"><?php echo wp_kses_post( $slide['b_button_one'] ); ?></a></li>

						<li><a href="<?php echo esc_url( $slide['b_url_two'] ); ?>" class="btn btn-white wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="2s"><?php echo wp_kses_post( $slide['b_button_two'] ); ?></a></li>

					</ul>

		        <?php };  ?>

			</div>

			<div class="intro-bg re-animate"><?php
				sp_theme_display_image( $slide['image'], 'sp-section-bg' );
            ?></div>

			<?php if ( $slide['add_dotted_pattern'] === 'yes' ): ?>
				<div class="intro-dotted-bg"></div>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</section>