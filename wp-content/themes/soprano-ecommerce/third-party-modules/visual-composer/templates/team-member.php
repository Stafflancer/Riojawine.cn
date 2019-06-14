<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<div class="sp-team-block <?php echo esc_attr( $el_class ); ?>">
	<div class="image">
		<?php sp_theme_display_resized_image( $image, 255 ); ?>

        <div class="soc-links">
            <ul>
				<?php if ( $facebook ) : ?>
                    <li>
                        <a href="<?php echo esc_url( $facebook ); ?>" target="_blank">
                            <i class="icon-facebook"></i>
                        </a>
                    </li>
                <?php endif; ?>

				<?php if ( $twitter ) : ?>
                    <li>
                        <a href="<?php echo esc_url( $twitter ); ?>" target="_blank">
                            <i class="icon-twitter"></i>
                        </a>
                    </li>
                <?php endif; ?>

				<?php if ( $instagram ) : ?>
                    <li>
                        <a href="<?php echo esc_url( $instagram ); ?>" target="_blank">
                            <i class="icon-instagram"></i>
                        </a>
                    </li>
                <?php endif; ?>

				<?php if ( $linkedin ) : ?>
                    <li>
                        <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank">
                            <i class="icon-linkedin"></i>
                        </a>
                    </li>
                <?php endif; ?>

				<?php if ( $dribbble ) : ?>
                    <li>
                        <a href="<?php echo esc_url( $dribbble ); ?>" target="_blank">
                            <i class="icon-dribbble"></i>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ( $pinterest ) : ?>
                    <li>
                        <a href="<?php echo esc_url( $pinterest ); ?>" target="_blank">
                            <i class="icon-pinterest"></i>
                        </a>
                    </li>
                <?php endif; ?>

				<?php if ( $google ) : ?>
                    <li>
                        <a href="<?php echo esc_url( $google ); ?>" target="_blank">
                            <i class="icon-google-plus"></i>
                        </a>
                    </li>
                <?php endif; ?>

				<?php if ( $youtube ) : ?>
                    <li>
                        <a href="<?php echo esc_url( $youtube ); ?>" target="_blank">
                            <i class="icon-youtube"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

	<div class="title"><h4><?php echo wp_kses_post( $title ); ?></h4></div>
	<div class="type"><?php echo wp_kses_post( $type ); ?></div>
</div>