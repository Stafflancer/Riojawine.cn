<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<?php $portfolio_list_atts = array(
	'class'  => 'sp-portfolio-list ' . esc_attr( $el_class ),
);?>

<div class="sp-portfolio-single <?php echo esc_attr( $el_class ); ?>">
	<?php if ( $title == true ) : ?><h4><?php echo trim( wp_kses_post( $title ) ); ?></h4><?php endif; ?>
	<?php if ( $text == true ) : echo wp_kses_post( wpautop( $text ) ); endif; ?>
    <div <?php echo html_build_attributes( $portfolio_list_atts ); ?>>
        <ul>
			<?php if ( $date == true ) : ?>
                <li><i class="icon-ion-ios-time-outline"></i> <?php echo wp_kses_post( $date ); ?></li>
			<?php endif; ?>

			<?php if ( $service == true ) : ?>
                <li><i class="icon-ion-ios-gear-outline"></i> <?php echo wp_kses_post( $service ); ?></li>
			<?php endif; ?>

			<?php if ( $client == true ) : ?>
                <li><i class="icon-ion-ios-people-outline"></i> <?php echo wp_kses_post( $client ); ?></li>
			<?php endif; ?>
        </ul>
    </div>
</div>