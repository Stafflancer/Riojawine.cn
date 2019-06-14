<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

if ( ! function_exists( 'sp_theme_render_comment' ) ) :
	function sp_theme_render_comment( $comment, $args, $depth ) {
		global $post; ?>

        <li <?php comment_class(); ?>>
            <div id="comment-<?php comment_ID(); ?>">
                <div class="comment-meta comment-author vcard">
                    <?php echo get_avatar( $comment, 80 ); ?>

                    <?php printf( '<h5 class="author-card">%1$s</h5>', get_comment_author_link() ); ?>

                    <div class="comment-time"><?php printf( esc_html__( '%1$s at %2$s', 'soprano-ecommerce' ), get_comment_date(), get_comment_time() ); ?></div>
                </div>

                <div class="comment-content">
                    <?php comment_text(); ?>
                </div>

	            <?php if ( '0' == $comment->comment_approved ) : ?>
                    <div class="comment-awaiting-moderation">
			            <?php esc_html_e( 'Your comment is awaiting moderation.', 'soprano-ecommerce' ); ?>
                    </div>
	            <?php endif; ?>

                <div class="comment-footer d-flex">
                    <div class="reply mr-auto">
                        <?php comment_reply_link( array_merge( $args,
                            array( 'reply_text' => esc_html__( 'Reply', 'soprano-ecommerce' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    </div>

                    <?php edit_comment_link( esc_html__( 'Edit', 'soprano-ecommerce' ), '<div class="edit-link">', '</div>' ); ?>
                </div>
            </div>
        </li><?php
	}
endif; ?>

<?php
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() || ! post_type_supports( get_post_type(), 'comments' ) ) {
	return;
} ?>

<section class="sp-section little sp-comments-area entry-comments" id="comments" data-sp-nojump>
	<?php if ( ! comments_open() ) : ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'soprano-ecommerce' ); ?></p>
	<?php endif; ?>

	<?php if ( have_comments() ) : ?>
        <h3 class="comments-title">
			<?php printf(
                _n( 'One Comment', '%1$s Comments', get_comments_number(), 'soprano-ecommerce' ),
                number_format_i18n( get_comments_number() )
            ); ?>
        </h3>

        <ol class="commentlist commentlist-root">
			<?php wp_list_comments( array( 'callback' => 'sp_theme_render_comment', 'style' => 'ol' ) ); ?>
        </ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav class="navigation" data-sp-nojump>
                <div class="nav-previous">
                    <?php previous_comments_link( esc_html__( '&larr; Older Comments', 'soprano-ecommerce' ) ); ?>
                </div>

                <div class="nav-next">
                    <?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'soprano-ecommerce' ) ); ?>
                </div>
            </nav>
		<?php endif; ?>

    <?php endif; ?>

	<?php
	$commenter = wp_get_current_commenter();
	$defaults  = array(
		'fields' => array(
			'author' => '<div class="form-group"><label class="sr-only" for="cf-name">' . esc_html__( 'Your Name', 'soprano-ecommerce' ) . '</label><input class="form-control" id="author" name="author" type="text" placeholder="' . esc_attr__( 'Your Name', 'soprano-ecommerce' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '"></div>',

			'email' => '<div class="form-group"><label class="sr-only" for="cf-name">' . esc_html__( 'Your E-mail', 'soprano-ecommerce' ) . '</label><input class="form-control" id="email" name="email" type="email" placeholder="' . esc_attr__( 'Your E-mail', 'soprano-ecommerce' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '"></div>',

			'url' => '<div class="form-group"><label class="sr-only" for="cf-name">' . esc_html__( 'Your Website', 'soprano-ecommerce' ) . '</label><input class="form-control" id="url" name="url" type="text" placeholder="' . esc_attr__( 'Your Site Url', 'soprano-ecommerce' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '"></div>',
		),
		'comment_field' => '<div class="form-group"><label class="sr-only" for="cf-message">' . esc_html__( 'Your Comment', 'soprano-ecommerce' ) . '</label><textarea class="form-control" id="comment" name="comment" placeholder="' . esc_attr__( 'Your Comment', 'soprano-ecommerce' ) . '" cols="45" rows="6"  aria-required="true" required="required"></textarea></div>',

		'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . esc_html__( 'Your email address will not be published.', 'soprano-ecommerce' ) . '</span> ' . esc_html__( 'All fields are required.', 'soprano-ecommerce' ) . '</p>',
		'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
		'title_reply_after'    => '</h3>',
		'cancel_reply_before'  => '&nbsp;<small>',
		'cancel_reply_after'   => '</small>',
		'cancel_reply_link'    => esc_html__( 'Cancel', 'soprano-ecommerce' ),
		'label_submit'         => esc_html__( 'Leave comment', 'soprano-ecommerce' ),
		'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="btn btn-primary %3$s" value="%4$s" />',
		'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',
	);

	comment_form( $defaults ); ?>
</section>