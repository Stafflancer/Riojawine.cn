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

					<?php 
					if (strcmp(esc_url($slide['s_link']), "#") !== 0 && strcmp(str_replace(" ", "", $slide['s_link']), "") !== 0){ ?>
						<div class="wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="2s">
							<a href="<?php echo esc_url( $slide['s_link'] ); ?>" class="btn btn-primary"><?php echo wp_kses_post( $slide['s_button'] ); ?></a>
						</div>
					<?php } ?>
				<?php } elseif ($slide['layout'] === 'text')  { ?>

		            <div class="intro-title intro-title-1 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="1s"><h1><?php echo wp_kses_post( $slide['t_title'] ); ?></h1></div>

		            <p class="wow fadeIn" data-wow-duration="1.5s" data-wow-delay="1.5s"><?php echo wp_kses_post( $slide['t_text'] ); ?></p>

					<?php 
						if (strcmp(esc_url($slide['t_link']), "#") !== 0 && strcmp(str_replace(" ", "", $slide['t_link']), "") !== 0){ ?>
							<div class="wow fadeInUp sp-marg50" data-wow-duration="1.5s" data-wow-delay="1s">
								<a href="<?php echo esc_url( $slide['t_link'] ); ?>" class="btn btn-primary"><?php echo wp_kses_post( $slide['t_button'] ); ?></a>
							</div>
					<?php } ?>
		            <?php if ($slide['t_arrow'] == true) { ?><a class="sp-scroll-down-cta hidden-xs-down wow fadeIn" href="#sp-about" data-wow-duration="1.5s" data-wow-delay="2s"><span><i class="icon-ion-ios-arrow-thin-down"></i></span></a><?php }; ?>

		        <?php } elseif ($slide['layout'] === 'video')  { ?>
					
					<div class="intro-title intro-title-1 wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay="1.5s"><h1><?php //echo wp_kses_post( $slide['v_title'] ); ?></h1></div>

					<!--<h4 class="intro-title intro-title-3 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="1.5s"><?php //echo wp_kses_post( $slide['v_subtitle'] ); ?></h4>-->
					<p class="wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="1.5s"><?php //echo wp_kses_post( $slide['v_subtitle'] ); ?></p>

					


		        <?php } elseif ($slide['layout'] === 'buttons')  { ?>

		            <div class="intro-title intro-title-1 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="1s"><h1><?php echo wp_kses_post( $slide['b_title'] ); ?></h1></div>

		            <div class="intro-title intro-title-3 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="1.5s"><?php echo wp_kses_post( $slide['b_subtitle'] ); ?></div>

					<ul class="list-inline intro">

						<li><a href="<?php echo esc_url( $slide['b_url_one'] ); ?>" class="btn btn-border wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay="2s"><?php echo wp_kses_post( $slide['b_button_one'] ); ?></a></li>

						<li><a href="<?php echo esc_url( $slide['b_url_two'] ); ?>" class="btn btn-white wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="2s"><?php echo wp_kses_post( $slide['b_button_two'] ); ?></a></li>

					</ul>

		        <?php };  ?>

			</div>
			<?php if ($slide['layout'] === 'video')  { ?>
				
				<div class="intro-bg-video">
					<video id="myVideo" autoplay muted loop>
					  <source src="<?php echo esc_url( $slide['v_video'] ); ?>" type="video/mp4">
					</video>
					
				</div>
				
				<script>
					jQuery(document).ready(function() {
						var vid = document.getElementById("myVideo");
						vid.autoplay = true;
						vid.load();
					});
				</script>
			<?php
			
			} else{?>
				
			<div class="intro-bg re-animate">
			<?php 
			
				sp_theme_display_image( $slide['image'], 'sp-section-bg' );
			
            ?>
			</div>
			<?php }
			
			?>

			<?php if ( $slide['add_dotted_pattern'] === 'yes' ): ?>
				<div class="intro-dotted-bg"></div>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</section>