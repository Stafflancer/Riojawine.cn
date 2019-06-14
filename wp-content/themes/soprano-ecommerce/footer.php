<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

    <footer id="sp-footer" class="<?php echo esc_attr( sp_theme_opt( 'footer_mode' ) ); ?>">
        <?php if ( is_active_sidebar( 'sp-footer-sidebar' ) ): ?>
        <div class="sp-main-footer">
            <div class="container">
                <div class="row"><?php dynamic_sidebar( 'sp-footer-sidebar' ); ?></div>
            </div>
        </div>
        <?php endif; ?>

        <div class="sp-end-footer">
            <div class="container">
                <div class="end-footer-block"><?php
                    sp_theme_display_footer_text();
                ?></div>

                <div class="end-footer-block menu-block"><?php
                    sp_theme_display_navigation( 'footer', 1 );
                ?></div>
            </div>
        </div>
    </footer>

    <div id="sp-footer-sizing-helper"></div>

</div> <!-- end of .sp-theme-root-wrapper -->

<?php wp_footer(); ?>
</body></html>