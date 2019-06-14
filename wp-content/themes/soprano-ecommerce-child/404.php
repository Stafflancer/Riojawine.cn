<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<?php wp_head(); ?>
    </head>

<body <?php body_class(); ?>>

<div id="sp-preloader"></div>

<?php // section attributes
$s_atts = array(
	'id'    => 'sp-404',
	'class' => 'sp-intro sp-intro-image fullscreen'
);

// add kenburns effect if enabled in theme options
if ( strtolower( sp_theme_opt( '404_ken_burns_effect' ) ) === 'yes' ) {
	$s_atts['class'] .= ' kenburns';
} ?>

<div id="sp-wrapper">
    <section <?php echo html_build_attributes( $s_atts ); ?>>
        <div class="intro-bg"><?php
			$bg_image = sp_theme_opt( '404_background_image' );

			if ( $bg_image ) {
				sp_theme_display_image( $bg_image, 'sp-section-bg' );
			} else {
				$placeholder_atts = array(
					'src' => get_theme_file_uri( 'public/images/default-404.jpg' ),
					'alt' => get_the_title()
				);

				echo sp_theme_build_tag( 'img', $placeholder_atts );
			}
			?></div>

        <div class="intro-dotted-bg"></div>

        <div class="intro-body">
            <?php // default strings
            $def_headline  = esc_html__( '404 Error', 'soprano-ecommerce' );
            //$def_subscript = esc_html__( 'Houston, We Have A Problem', 'soprano-ecommerce' ); ?>

            <h3><?php echo wp_kses_post( sp_theme_opt( '404_headline_subscript', $def_subscript ) ) ?></h3>
            <h1><?php echo wp_kses_post( sp_theme_opt( '404_main_headline', $def_headline ) ) ?></h1>

            <div class="sp-soc-icons">
				<?php sp_theme_site_socials(); ?>
            </div>

            <nav class="sp-404-menu">
				<?php sp_theme_display_navigation( '404-page', 1 ); ?>
            </nav>
        </div>
    </section>
</div>

<?php wp_footer(); ?>
</body></html>