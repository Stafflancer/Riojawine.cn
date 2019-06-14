<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<div class="sp-faq-list <?php echo esc_attr( $el_class ); ?>">
	<?php foreach ( $faqs as $tab_index => $faq ): ?>
        <?php $card_atts = array( 'class' => 'card sp-faq-card' );
		if ( ($tab_index + 1) == $open_tab ) { $card_atts['class'] .= ' card-open'; } ?>

        <div <?php echo html_build_attributes( $card_atts ); ?>>
			<div class="card-header">
				<h5 class="card-title"><?php echo wp_kses_post( trim( $faq['title'] ) ); ?></h5>
				<div class="toggle-icon"><i class="icon-ion-ios-plus-empty"></i></div>
			</div>
			<div class="card-contents collapse">
	    		<div class="card-contents-inner">
	        		<?php echo wp_kses_post( wpautop( $faq['text'] ) ); ?>
	    		</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>