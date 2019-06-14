<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<?php $pricing_atts = array(
	'class'  => 'pricing_tables_wrap ' . esc_attr( $el_class ),
);?>

<div <?php echo html_build_attributes( $pricing_atts ); ?>>
	<div class="pricing_tables_name"><?php echo esc_attr( $name ); ?></div>
	<h2 class="pricing_tables_price"><span><?php echo esc_attr( $currency ); ?></span><?php echo esc_attr( $value ); ?><?php if($period == true){ ?><i>/ <?php echo esc_attr( $period ); ?></i><?php }; ?></h2>
	<div class="pricing_tables_desc">
		<ul>
			<?php foreach ( $services as $service ): ?>
	        	<li>
	                <?php echo do_shortcode( wp_kses_post( $service['text'] ) ); ?>
	        	</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="pricing_tables_buttons">
		<?php if($button !== 'double'){ ?>
    		<a href="<?php echo esc_url( $button_link_one ); ?>" class="btn btn-primary"><?php echo esc_attr( $button_text_one ); ?></a>
		<?php } else { ?>
			<div class="btn-group">
				<a href="<?php echo esc_url( $button_link_two ); ?>" class="btn btn-outline-primary"><?php echo esc_attr( $button_text_two ); ?></a>
				<a href="<?php echo esc_url( $button_link_three ); ?>" class="btn btn-outline-primary"><?php echo esc_attr( $button_text_three ); ?></a>
			</div>
		<?php }; ?>
	</div>
</div>