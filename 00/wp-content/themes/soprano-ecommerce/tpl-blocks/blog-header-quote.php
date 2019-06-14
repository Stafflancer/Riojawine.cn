<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );
$post_quote = sp_theme_post_opt( 'quote_text' );
if ( ! trim( $post_quote ) ) {
	return;
} ?>

<div class="sp-blog-quote">
    <div class="quote-icon">
        <i class="icon-ion-ios-chatbubble-outline"></i>
    </div>

    <div class="quote-inner">
	    <?php echo wp_kses_post( $post_quote ); ?>

        <div class="blockquote-footer"><?php
            echo wp_kses_post( sp_theme_post_opt( 'quote_author', '' ) );
        ?></div>
    </div>
</div>