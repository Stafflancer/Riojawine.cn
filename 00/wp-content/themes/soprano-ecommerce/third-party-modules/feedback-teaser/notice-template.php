<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/**
 * @var $this SopranoTheme_FeedbackTeaser
 */

$logo_uri       = get_parent_theme_file_uri( 'third-party-modules/feedback-teaser/static/logo.png' );
$stylesheet_uri = get_parent_theme_file_uri( 'third-party-modules/feedback-teaser/static/styles.css' );
$scripts_uri    = get_parent_theme_file_uri( 'third-party-modules/feedback-teaser/static/scripts.js' ); ?>

<!-- Notice Markup -->
<div class="sp-notice" style="display: none;" data-wp-nonce="<?php echo esc_attr( wp_create_nonce() ) ?>">
    <div class="sp-notice-body">
        <div class="sp-notice-body-inner current">
			<?php $time_diff = human_time_diff( $this->theme_first_installation_date() ); ?>

            <h1>Whoa! You've been using <strong>Soprano theme</strong> for more than week! <i class="em-party-popper"></i></h1>

            <p>Have you satisfied with our product or have run into any issues? Please share
                your experience with us. This will help us to become even better!</p>

            <div class="sp-buttons">
                <a href="#" class="sp-green" data-action="change-body" data-new-body="rating">Great Theme!</a>
                <a href="#" class="sp-red" data-action="change-body" data-new-body="support">I'm not satisfied</a>
                <a href="#" class="sp-seamless" data-action="snooze">Ask me later</a>
            </div>
        </div>

        <div class="sp-notice-body-inner" data-body-id="rating">
            <h1>We need your help to spread the world! <i class="em-glowing-star"></i></h1>

            <p>If you really appreciate our work, please give our theme <strong>5 stars</strong> and
                write review on ThemeForest. It is very important for us.</p>

            <div class="sp-buttons">
                <a href="https://goo.gl/HQwFNp" target="_blank" class="sp-green" data-action="change-body" data-new-body="thanks">Write review!</a>
                <a href="https://goo.gl/i8WRbo" target="_blank" class="sp-gray">How to set rating?</a>
                <a href="#" class="sp-seamless" data-action="snooze">Not now</a>
            </div>
        </div>

        <div class="sp-notice-body-inner" data-body-id="support">
            <h1>Troubles? We're always ready to help! <i class="em-happy-person"></i></h1>

            <p>In case of any questions or troubles feel free to reach our support team.
                Our experienced developers will help you ASAP.</p>

            <div class="sp-buttons">
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=pzt-support-module' ) ) ?>" class="sp-green">Contact Support</a>
                <a href="#" class="sp-seamless" data-action="close">No, thanks</a>
            </div>
        </div>

        <div class="sp-notice-body-inner" data-body-id="thanks">
            <h1>You're the best! <i class="em-clapping-hands"></i></h1>

            <p>We strongly appreciate your choice and opinion. Thanks for your time and feedback.
                This notification won't be shown again.</p>

            <div class="sp-buttons">
                <a href="#" class="sp-seamless" data-action="close">Close message</a>
            </div>
        </div>
    </div>

    <div class="sp-logo">
        <img src="<?php echo esc_url( $logo_uri ); ?>" alt="PuzzleThemes Logo">
    </div>
</div>

<!-- Styles & Scripts -->
<link rel="stylesheet" href="<?php echo esc_url( $stylesheet_uri ); ?>"/>
<script src="<?php echo esc_url( $scripts_uri ); ?>"></script>