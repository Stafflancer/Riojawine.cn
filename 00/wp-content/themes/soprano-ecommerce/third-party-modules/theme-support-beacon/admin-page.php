<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<style type="text/css">
    .wrap {
        max-width  : 880px;
        background : #fff;
        padding    : 30px;
        border     : 1px solid #eee;
        margin     : 30px 30px 30px 10px;
    }

    h1, h2, h3, h4, h5, h6 { margin-top : 0; }

    hr { margin : 30px 0; }

    ul:last-child, ul li:last-child { margin-bottom : 0; }

    .split-columns {
        margin : -15px -50px;
    }

    .split-columns:after {
        content : "";
        display : table;
        clear   : both;
    }

    .split-columns > .one-column {
        box-sizing : border-box;
        float      : left;
        width      : 50%;
        padding    : 15px 50px;
    }

    .pzt-red {
        color : #F44336;
    }

    #pzt-open-beacon {
        display        : inline-block;
        vertical-align : middle !important;
        margin-right   : 10px;
    }

    @media (max-width : 768px) {
        .split-columns > .one-column { width : 100%; }
    }
</style>

<div class="wrap" id="pzt-support-module">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

	<p><strong>Dear customer!</strong> Before you post a ticket, please read our support policy(below) or <a href="https://www.youtube.com/watch?v=LVRPJNc9rmw" target="_blank">watch this video</a>.</p>

	<hr>

	<div class="split-columns">
		<div class="one-column">
			<h2>Regular item support includes:</h2>
			<ul class="ul-square">
				<li>Responding to questions or problems regarding the item and its features</li>
				<li>Fixing confirmed bugs in the theme code</li>
				<li>Providing updates to ensure compatibility with new WordPress versions</li>
			</ul>
		</div>

		<div class="one-column">
			<h2>Regular support <span class="pzt-red">DOES NOT</span> include:</h2>
			<ul class="ul-square">
				<li>Customization and installation services</li>
				<li>Support for third party plugins and non-theme related code</li>
			</ul>
		</div>
	</div>

	<hr>

	<h2>Theme customizations</h2>
	<p>Changing the appearance or functionality of the theme to do something it was not intended to door seen on the demo site is not part of the regular support policy.</p>
    <p>If you want to customize a theme to do something it was not intended to do (or doesn’t have an option for), then we will offer you our paid services, just select proper subject in our form and we'll send you our rates in the reply.</p>

	<hr>

	<h2>Custom modifications support</h2>
	<p>We do not provide support for custom modifications made by customers or other developers to the original theme code. You still can edit theme as you like, but we'll provide fixes/advices only for original parts of the theme.</p>

	<hr>
	<p style="text-align: center">
		<a href="#" class="button button-primary button-large" id="pzt-open-beacon">New support request</a>
		<span>... or reach us by email - <a href="mailto:support@puzzlethemes.net">support@puzzlethemes.net</a></span>
	</p>
</div>

<script type="text/javascript">
    jQuery('#pzt-open-beacon').on('click', function (e) {
        e.preventDefault();
        HS.beacon.open();
    });

	jQuery(window).one('pzt.beacon-loaded', function() {
        HS.beacon.destroy();
        HS.beacon.config({ modal: true });
        HS.beacon.init();
	});
</script>