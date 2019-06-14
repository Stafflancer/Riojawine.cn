<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<div class="sp-portfolio-block <?php echo esc_attr( $el_class ); ?>">
    <!-- Portfolio sorting -->
	<?php if ( $filters_layout !== 'hide-filter' ): ?>
        <ul class="sp-portfolio-sorting <?php echo esc_attr( $filters_layout ) ?>">
            <li class="active">
                <a href="#" data-group="all"><?php esc_html_e( 'All', 'soprano-ecommerce' ); ?></a>
            </li>

            <?php foreach ( $items_tags as $item_tag ): ?>
                <li>
                    <a href="#" data-group="<?php printf( 'tag-%d', $item_tag->term_id ); ?>"><?php
                        echo esc_html( trim( $item_tag->name ) );
                    ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
	<?php endif; ?>

    <!-- Portfolio items -->
    <div class="sp-portfolio-items <?php echo esc_attr( $layout_columns . ' ' . $gutters_size ); ?>">
		<?php foreach ( $items as $item ) :
		    if ( ! isset( $item['id'] ) ) { continue; }
		    $post = get_post( $item['id'] );
		    if ( ! $post ) { continue; }

			$item_atts = array(
				'class'       => 'sp-portfolio-item-wrap ' . esc_attr( $item['layout'] ),
				'data-groups' => $this->get_item_tags_as_attr( $post->ID )
			);

			$excerpt_length = ( $item['layout'] ) ? 150 : 50; ?>
            <div <?php echo html_build_attributes( $item_atts ); ?>>
                <div <?php post_class( 'sp-portfolio-item', $post->ID ) ?>>
                    <div class="portfolio-bg-image">
                        <?php sp_theme_display_image( get_post_thumbnail_id( $post->ID ), 'medium_large' ); ?>
                    </div>

                    <div class="portfolio-hover">
                        <h5 class="entry-title">
                            <?php echo get_the_title( $post->ID ); ?>
                        </h5>
                        <div class="entry-excerpt">
                            <?php echo get_the_excerpt( $post->ID ); ?>
                        </div>
                        <div class="link-icon">
                            <i class="icon-ion-ios-arrow-thin-right"></i>
                        </div>
                    </div>

                    <a href="<?php the_permalink( $post->ID ); ?>" class="link-overlay">
                        <?php esc_html_e( 'Read more', 'soprano-ecommerce' ); ?>
                    </a>
                </div>
            </div>
		<?php endforeach; ?>

        <div class="sp-portfolio-sizer"></div>
    </div>
</div>