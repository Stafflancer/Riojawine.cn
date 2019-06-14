<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<?php $lists_atts = array(
	'class'  => 'sp-faq-articles ' . esc_attr( $el_class ),
);?>

<div <?php echo html_build_attributes( $lists_atts ); ?>>
	<ul>
	<?php foreach ( $lists as $list ): ?>
		<li>
	        <a href="<?php echo esc_url( $list['link'] ); ?>"><?php echo wp_kses_post( $list['title'] ); ?></a>
	    </li>
	<?php endforeach; ?>
	</ul>
</div>