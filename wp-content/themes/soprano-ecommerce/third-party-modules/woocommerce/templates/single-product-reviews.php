<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 *
 * @version      100.0
 * @orig_version 3.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">
		<?php if ( have_comments() ) : ?>
			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="sp-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>
		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? __( 'Add a review', 'soprano-ecommerce' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'soprano-ecommerce' ), get_the_title() ),
						'title_reply_to'       => __( 'Leave a Reply to %s', 'soprano-ecommerce' ),
						'title_reply_before'   => '<span id="reply-title" class="comment-reply-title">',
						'title_reply_after'    => '</span>',
						'comment_notes_after'  => '',
						'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . esc_html__( 'Your email address will not be published.', 'soprano-ecommerce' ) . '</span> ' . esc_html__( 'All fields are required.', 'soprano-ecommerce' ) . '</p>',
						'fields' => array(
                            'author' => '<div class="form-group"><label class="sr-only" for="cf-name">' . esc_html__( 'Your Name', 'soprano-ecommerce' ) . '</label><input class="form-control" id="author" name="author" type="text" placeholder="' . esc_attr__( 'Your Name', 'soprano-ecommerce' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '"></div>',
                            'email' => '<div class="form-group"><label class="sr-only" for="cf-name">' . esc_html__( 'Your E-mail', 'soprano-ecommerce' ) . '</label><input class="form-control" id="email" name="email" type="email" placeholder="' . esc_attr__( 'Your E-mail', 'soprano-ecommerce' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '"></div>'
                        ),
                        'label_submit' => __('Submit', 'soprano-ecommerce'),
                        'submit_button' => '<button type="submit" class="btn btn-primary %3$s">%4$s</button>',
                        'logged_in_as' => '',
                        'comment_field' => '',
                    );

					if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
						$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'soprano-ecommerce' ), esc_url( $account_page_url ) ) . '</p>';
					}

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating:', 'soprano-ecommerce' ) . '</label><select name="rating" id="rating" aria-required="true" required>
							<option value="">' . esc_html__( 'Rate&hellip;', 'soprano-ecommerce' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'soprano-ecommerce' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'soprano-ecommerce' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'soprano-ecommerce' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'soprano-ecommerce' ) . '</option>
							<option value="1">' . esc_html__( 'Very poor', 'soprano-ecommerce' ) . '</option>
						</select></div>';
					}

					$comment_form['comment_field'] .= '<div class="form-group"><label class="sr-only" for="cf-message">' . esc_html__( 'Your Comment', 'soprano-ecommerce' ) . '</label><textarea class="form-control" id="comment" name="comment" placeholder="' . esc_attr__( 'Your Comment', 'soprano-ecommerce' ) . '" cols="45" rows="6"  aria-required="true" required="required"></textarea></div>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'soprano-ecommerce' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
