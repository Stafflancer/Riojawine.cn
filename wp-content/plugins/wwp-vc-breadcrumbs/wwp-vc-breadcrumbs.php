<?php
/*
    Plugin Name: Breadcrumbs for Visual Composer
    Plugin URI: http://workingwithpixels.com/breadcrumbs-visual-composer
    Description: Allows you to easily add breadcrumbs using Visual Composer.
    Version: 1.2
    Author: WWP
    Author URI: http://www.workingwithpixels.com/
    Copyright: WWP, 2016
*/

if (!defined('ABSPATH')) die('-1');

if(!class_exists('WWWP_VC_BREADCRUMBS'))
{
    function init_wwp_vc_breadcrumbs()
    {
        if(!defined('WPB_VC_VERSION'))
        {
            add_action('admin_notices', 'wwp_vc_breadcrumbs_notice__error');
        }
    }
    add_action('admin_init', 'init_wwp_vc_breadcrumbs');

    function wwp_vc_breadcrumbs_notice__error()
    {
        $class = 'notice notice-error';
        $message = 'Breadcrumbs for Visual Composer: Please check if Visual Composer is active on your website.';

        printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
    }

    class WWWP_VC_BREADCRUMBS
    {
        function defines()
        {
            defined('wwp_vc_breadcrumbs_name')  ||  define('wwp_vc_breadcrumbs_name', 'WWP');
            defined('wwp_vc_breadcrumbs_dir')  ||  define('wwp_vc_breadcrumbs_dir', plugin_dir_path( __FILE__ ));
            defined('wwp_vc_breadcrumbs_inc')  ||  define('wwp_vc_breadcrumbs_inc', wwp_vc_breadcrumbs_dir . 'include/');
        }

        function __construct()
        {
            $this->defines();

            function wwp_vc_breadcrumbs_init_admin_css()
            {
                wp_enqueue_style('wwp-vc-breadcrumbs-admin', plugins_url( 'include/css/wwp-vc-breadcrumbs-admin.css', __FILE__ ));
            }
            add_action('admin_enqueue_scripts', 'wwp_vc_breadcrumbs_init_admin_css');

            add_action('init', array(__CLASS__, 'register_wwp_vc_breadcrumbs_styles'));
            add_action('wp_head', array(__CLASS__, 'print_wwp_vc_breadcrumbs_styles'));

            require_once(wwp_vc_breadcrumbs_inc . 'core/wwp_functions.php');
            require_once(wwp_vc_breadcrumbs_inc . 'core/dynamic_breadcrumbs.php');
            require_once(wwp_vc_breadcrumbs_inc . 'core/static_breadcrumbs.php');
            require_once(wwp_vc_breadcrumbs_inc . 'core/static_breadcrumbs_item.php');
        }

        static function register_wwp_vc_breadcrumbs_styles()
        {
            wp_register_style('wwp-vc-breadcrumbs', plugins_url('include/css/wwp-vc-breadcrumbs.css', __FILE__ ));
        }

        static function print_wwp_vc_breadcrumbs_styles()
        {
            if(!is_404())
            {
                global $post;

                if(has_shortcode($post->post_content, 'wwp_vc_breadcrumbs_static') || has_shortcode($post->post_content, 'wwp_vc_breadcrumbs_dynamic'))
                {
                    wp_print_styles('wwp-vc-breadcrumbs');
                }
            }
        }
    }
}
new WWWP_VC_BREADCRUMBS();