<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see           https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 *
 * @version      100.0
 * @orig_version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<div id="sp-wrapper" class="sp-woocommerce-page">

    <!-- Page intro -->
    <section class="sp-intro sp-intro-image sp-woo-intro">
        <div class="intro-bg"><?php sp_theme_display_intro_bg(); ?></div>
        <div class="intro-body">
            <div class="intro-title intro-title-1 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
                <?php woocommerce_page_title(); ?>
            </div>

            <div class="sp-woo-breadcrumbs wow fadeIn animated" data-wow-duration="1s" data-wow-delay="1s">
                <?php woocommerce_breadcrumb(); ?>
            </div>
        </div>
    </section>

    <?php
    /**
     * woocommerce_before_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked WC_Structured_Data::generate_website_data() - 30
     */
    do_action( 'woocommerce_before_main_content' );
    ?>

    <div class="woocommerce-products-header sp-archive-description">
        <?php
        /**
         * woocommerce_archive_description hook.
         *
         * @hooked woocommerce_taxonomy_archive_description - 10
         * @hooked woocommerce_product_archive_description - 10
         */
        do_action( 'woocommerce_archive_description' );
        ?>
    </div>

    <!-- WooCommerce page content & pagination -->
    <section class="sp-section">
        <div class="container" id="sp-woo-inner">
            <div class="content-column">
                <?php if ( have_posts() ) : ?>
                    <div class="woocommerce-before-shop clearfix">
                        <?php
                        /**
                         * woocommerce_before_shop_loop hook.
                         *
                         * @hooked wc_print_notices - 10
                         * @hooked woocommerce_result_count - 20
                         * @hooked woocommerce_catalog_ordering - 30
                         */
                        do_action( 'woocommerce_before_shop_loop' );
                        ?>
                    </div>

                    <?php woocommerce_product_loop_start(); ?>

                    <?php while ( have_posts() ) :
                        the_post();

                        /**
                         * woocommerce_shop_loop hook.
                         *
                         * @hooked WC_Structured_Data::generate_product_data() - 10
                         */
                        do_action( 'woocommerce_shop_loop' );

                        wc_get_template_part( 'content', 'product' );
                    endwhile; ?>

                    <?php woocommerce_product_loop_end(); ?>

                    <?php
                    /**
                     * woocommerce_after_shop_loop hook.
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    do_action( 'woocommerce_after_shop_loop' );
                    ?>

                <?php else : ?>

                    <?php
                    /**
                     * woocommerce_no_products_found hook.
                     *
                     * @hooked wc_no_products_found - 10
                     */
                    do_action( 'woocommerce_no_products_found' );
                    ?>

                <?php endif; ?>
            </div>

            <?php sp_theme_get_template_part( 'tpl-blocks/sidebar-area.php', array( 'sidebar-id' => 'sp-woo-sidebar' ) ); ?>
        </div>
    </section>

    <?php
    /**
     * woocommerce_after_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action( 'woocommerce_after_main_content' );
    ?>

</div>

<?php get_footer( 'shop' );
