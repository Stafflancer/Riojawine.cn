<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<div class="sp-contacts-widget <?php echo esc_attr( $el_class ); ?>">
    <div class="sp-contacts-list">
        <ul>
			<?php if ( $location == true ) : ?>
                <li><i class="icon-ion-ios-location-outline"></i> <?php echo wp_kses_post( $location ); ?></li>
			<?php endif; ?>

			<?php if ( $phone == true ) : ?>
                <li><i class="icon-ion-ios-telephone-outline"></i> <?php echo wp_kses_post( $phone ); ?></li>
			<?php endif; ?>

			<?php if ( $email == true ) : ?>
                <li><i class="icon-ion-ios-email-outline"></i> <?php echo wp_kses_post( $email ); ?></li>
			<?php endif; ?>
        </ul>
    </div>

	<?php if ( $hr == true ) : ?><hr><?php endif; ?>
	<?php if ( $text == true ) : echo wp_kses_post( wpautop( $text ) ); endif; ?>
</div>