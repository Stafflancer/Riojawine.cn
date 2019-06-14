<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<div class="sp-loop-noposts text-center">
    <h2><?php esc_html_e( 'Sorry, Nothing Found', 'soprano-ecommerce' ); ?></h2>

    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

        <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'soprano-ecommerce' ), admin_url( 'post-new.php' ) ); ?></p>

    <?php elseif ( is_search() ) : ?>

        <p><?php esc_html_e( 'The posts you are looking for is not available. Maybe you want to perform a search?', 'soprano-ecommerce' ); ?></p>
        <?php get_search_form(); ?>

    <?php else : ?>

        <p><?php esc_html_e( 'It seems we can\'t find what you&rsquo;re looking for. Perhaps searching can help.', 'soprano-ecommerce' ); ?></p>
        <?php get_search_form(); ?>

    <?php endif; ?>
</div>