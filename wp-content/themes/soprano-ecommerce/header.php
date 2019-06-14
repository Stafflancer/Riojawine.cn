<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="sp-theme-root-wrapper">

    <div id="sp-preloader"></div>
    <div id="sp-top-scrolling-anchor"></div>

    <!-- "scroll to top" button -->
    <?php if ( sp_theme_opt( 'go_to_top_button' ) === 'Enabled' ): ?>
        <a href="#sp-top-scrolling-anchor" class="sp-scroll-top">
            <?php $button_text = sp_theme_opt( 'gotop_button_text', 'Go to top' ); ?>
            <span class="anno-text"><?php echo esc_html( $button_text ); ?></span>
            <i class="icon-angle-up"></i>
        </a>
    <?php endif; ?>

    <!-- site header -->
    <header id="sp-header" class="<?php echo esc_attr( sp_theme_opt( 'header_stuck_effect', 'stuck-transform' ) ); ?>">
        <div class="container-fluid" id="sp-header-inner">
            <div id="sp-header-right-block">
				<div class="logo-header">
					<a href="<?php echo esc_url( home_url() ); ?>" class="brand-logo">
						<?php sp_theme_display_site_identity(); ?>
					</a>
				</div>
                <nav id="sp-primary-nav">
                    <?php sp_theme_display_navigation('primary', 3); ?>

                    <a href="#" id="sp-mobile-nav-trigger">
                        <span></span><span></span>
                        <span></span><span></span>
                    </a>
                </nav>

                <?php if ( class_exists( 'WooCommerce' ) || sp_theme_opt( 'hide_search_from_header' ) === 'No' ): ?>
                    <div class="header-extras">
                        <?php if ( sp_theme_opt( 'hide_search_from_header' ) === 'No' ) : ?>
                            <a href="#" class="sp-search-icon">
                                <i class="icon-ion-ios-search-strong"></i>
                            </a>
                        <?php endif; ?>

                        <?php if ( class_exists( 'WooCommerce' ) ): ?>
                            <?php get_template_part( 'tpl-blocks', 'woocommerce-mini-cart' ); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- fullscreen search container -->
    <?php if ( sp_theme_opt( 'hide_search_from_header' ) === 'No' ): ?>
        <div id="sp-search-block-container">
            <div class="search-block-inner">
                <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="text"
                           class="search-input"
                           autocomplete="off"
                           placeholder="<?php esc_attr_e( 'Enter keyword...', 'soprano-ecommerce' ); ?>"
                           name="s">

                    <button type="submit" class="search-btn">
                        <i class="icon-ion-ios-search-strong"></i>
                    </button>
                </form>
            </div>

            <div class="close-search">
                <a href="#"><i class="icon-ion-ios-close-empty"></i></a>
            </div>
        </div>
    <?php endif; ?>

    <!-- fullscreen mobile menu -->
    <div id="sp-mobile-nav-container">
        <div class="overlay-inner-wrap">
            <nav><?php sp_theme_display_navigation( 'primary', 3 ); ?></nav>
            <div class="sp-soc-icons"><?php sp_theme_site_socials(); ?></div>
        </div>
    </div>

    <div id="sp-mobile-nav-bg"></div>
