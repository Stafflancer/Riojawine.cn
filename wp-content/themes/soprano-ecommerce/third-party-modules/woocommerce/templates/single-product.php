<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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
 * @orig_version 1.6.4
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
				<?php woocommerce_template_single_title(); ?>
			</div>

			<div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="1s">
				<?php woocommerce_breadcrumb(); ?>
			</div>
		</div>
	</section>

	<!-- Page contents -->
	<section class="sp-section">
		<div class="container">
			<?php
			/**
			 * woocommerce_before_main_content hook.
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 */
			do_action( 'woocommerce_before_main_content' );
			?>

			<?php while ( have_posts() ) {
				the_post();
				wc_get_template_part( 'content', 'single-product' );
			} ?>

			<?php
			/**
			 * woocommerce_after_main_content hook.
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action( 'woocommerce_after_main_content' );
			?>
		</div>
	</section>

</div>

<?php get_footer( 'shop' );