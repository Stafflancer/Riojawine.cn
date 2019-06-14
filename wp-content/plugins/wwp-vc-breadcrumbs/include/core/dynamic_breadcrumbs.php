<?php

add_action('init', 'create_wwp_vc_breadcrumbs_dynamic');
add_shortcode('wwp_vc_breadcrumbs_dynamic', 'wwp_vc_breadcrumbs_dynamic');

function create_wwp_vc_breadcrumbs_dynamic()
{
    if(!function_exists('vc_map'))
    {
        return;
    }

    vc_map(array(
        "name" => "Dynamic Breadcrumb",
        "base" => "wwp_vc_breadcrumbs_dynamic",
        "category" => wwp_vc_breadcrumbs_name,
        "icon" => "dynamic",
        "show_settings_on_create" => true,
        "description" => "Add breadcrumbs dynamically",
        "params" => array(
            array(
                "heading" => "Show homepage",
                "type" => "dropdown",
                "value" => array(
                    "Yes" => 1,
                    "No" => 0,
                ),
                "param_name" => "show_home",
                "std" => 1,
                "description" => "Show homepage in breadcrumb",
                "group" => "Settings"
            ),
            array(
                "heading" => "Show parent page",
                "type" => "dropdown",
                "value" => array(
                    "Yes" => 1,
                    "No" => 0,
                ),
                "param_name" => "show_parent",
                "std" => 1,
                "description" => "Show parent page in breadcrumb",
                "group" => "Settings"
            ),
            array(
                "heading" => "Show child pages",
                "type" => "dropdown",
                "value" => array(
                    "Yes" => 1,
                    "No" => 0,
                ),
                "param_name" => "show_child",
                "std" => 1,
                "description" => "Show child pages in breadcrumb",
                "group" => "Settings"
            ),

            array(
                "heading" => "Theme",
                "type" => "dropdown",
                "value" => array(
                    "Default" => 0,
                    "Custom Separator" => 1,
                    "Triangle" => 2,
                    "Multi-Steps" => 3,
                    "Dots" => 4,
                    "Dots with step counter" => 5,
                ),
                "param_name" => "theme",
                "std" => 0,
                "description" => "Breadcrumb theme",
                "group" => "Layout"
            ),

            array(
                "heading" => "Separator Type",
                "type" => "dropdown",
                "value" => array(
                    "Text" => 0,
                    "Font Awesome Icon" => 1,
                    "Image Upload" => 2
                ),
                "param_name" => "custom_separator_type",
                "std" => 0,
                "dependency" => array("element" => "theme", "value" => "1"),
                "description" => "Pick custom separator type",
                "group" => "Layout",
            ),

            array(
                "heading" => "Text Separator",
                "type" => "textfield",
                "param_name" => "text_separator",
                "value" => "",
                "dependency" => array("element" => "custom_separator_type", "value" => "0"),
                "description" => "Add your custom text separator",
                "group" => "Layout",
            ),

            array(
                "heading" => "Font Awesome Icon Separator",
                "type" => "textfield",
                "param_name" => "fa_icon_separator",
                "value" => "",
                "dependency" => array("element" => "custom_separator_type", "value" => "1"),
                "description" => 'Copy the icon (not the unicode) from  <a href="http://fontawesome.io/cheatsheet/" target="_blank">Font Aweosme cheatsheet</a>',
                "group" => "Layout",
            ),

            array(
                "heading" => "Image Separator",
                "type" => "attach_image",
                "param_name" => "image_separator",
                "dependency" => array("element" => "custom_separator_type", "value" => "2"),
                "group" => "Layout",
            ),

            array(
                "heading" => "Pages Position",
                "type" => "dropdown",
                "value" => array(
                    "Top" => "top",
                    "Bottom" => "bottom"
                ),
                "param_name" => "pages_position",
                "std" => "top",
                "dependency" => array("element" => "theme", "value" => array("4", "5")),
                "description" => "Pages position on breadcrumb",
                "group" => "Layout",
            ),

            array(
                "heading" => "Enable custom styling?",
                "type" => "dropdown",
                "value" => array(
                    "Yes" => "yes",
                    "No" => "no"
                ),
                "param_name" => "custom_styling",
                "std" => "no",
                "dependency" => Array("element" => "theme", "value" => array("2", "3", "4", "5")),
                "group" => "Layout",
            ),
            array(
                "heading" => "Default color",
                "type" => "colorpicker",
                "param_name" => "default_color",
                "value" => '#007C46',
                "dependency" => Array("element" => "custom_styling", "value" => "yes"),
                "description" => "Default breadcrumb color",
                'group' => "Styling"
            ),
            array(
                "heading" => "Active color",
                "type" => "colorpicker",
                "param_name" => "active_color",
                "value" => '#AFD236',
                "dependency" => Array("element" => "custom_styling", "value" => "yes"),
                "description" => "Active page breadcrumb color",
                'group' => "Styling"
            )
        )
    ));
}

function wwp_vc_breadcrumbs_dynamic($atts, $content = null)
{
    global $post;

    extract(shortcode_atts(array(
        "show_home" => "1",
        "show_parent" => "1",
        "show_child" => "1",
        "theme" => "0",
        "custom_separator_type" => "0",
        "text_separator" => "",
        "fa_icon_separator" => "",
        "image_separator" => "",
        "pages_position" => "top",
        "custom_styling" => "no",
        "default_color" => "#007C46",
        "active_color" => "#AFD236",
    ), $atts));

    $output = $add_theme_class = '';

    $id = "breadcrumb-".uniqid();

    if($theme == "0")
    {
        $output .= '<style>#'.$id.' li::after { content: "»" }</style>';
    }

    if($theme == "1")
    {
        if($custom_separator_type == 0)
        {
            $output .= '<style>#'.$id.' li::after { content:"'.htmlspecialchars_decode($text_separator).'" }</style>';
        }

        if($custom_separator_type == 1)
        {
            wp_enqueue_style( 'font-awesome' );
            $output .= '<style>#'.$id.' li::after { font-family: FontAwesome; content: "'.$fa_icon_separator.'" }</style>';
        }

        if($custom_separator_type == 2)
        {
            $icon_separator = wp_get_attachment_image_src($image_separator, 'full');
            if($icon_separator)
            {
                $icon_path = $icon_separator[0];
                $icon_width = $icon_separator[1];
                $icon_height = $icon_separator[2];
            }

            $output .= '<style>#'.$id.' li::after { content: ""; background: url("'.$icon_path.'"); width: '.$icon_width.'px; height: '.$icon_height.'px;) }</style>';
        }
    }

    if($theme == "2")
    {
        $output .= '
            <style>
                #'.$id.'.triangle li a {
                    background: '.$default_color.';
                }
                #'.$id.'.triangle li a:after {
                    border-left: 30px solid '.$default_color.';
                }
                #'.$id.'.triangle li:last-child {
                    background: '.$active_color.';
                }
            </style>
        ';
        $add_theme_class = 'triangle';
    }

    if($theme == "3")
    {
        $output .= '
            <style>
                #'.$id.'.multi-steps li.visited::after {
                    background-color: '.$default_color.';
                }
                #'.$id.'.multi-steps li::after {
                    background: '.$active_color.';
                }
                #'.$id.'.multi-steps.text-center li > * {
                    background: '.$active_color.';
                }
                #'.$id.'.multi-steps.text-center li.visited > *, #'.$id.'.multi-steps.text-center li.current > * {
                    background-color: '.$default_color.';
                }
            </style>
        ';
        $add_theme_class = 'multi-steps text-center';
    }

    if($theme == "4")
    {
        $output .= '
            <style>
                #'.$id.'.text-top li.visited > *::before, #'.$id.'.text-top li.current > *::before, #'.$id.'.text-bottom li.visited > *::before, #'.$id.'.text-bottom li.current > *::before {
                    background-color: '.$default_color.';
                }
                #'.$id.'.text-top a:hover, .wwp-vc-breadcrumbs.text-bottom a:hover {
                    color: '.$default_color.';
                }
                #'.$id.'.text-top li > *::before, #'.$id.'.text-bottom li > *::before {
                    background-color: ' . $active_color . ';
                }
                #'.$id.'.text-top li.visited > a:hover::before, #'.$id.'.text-bottom li.visited > a:hover::before {
                    box-shadow: 0 0 0 3px '.wwp_vc_breadcrumbs_hex_to_rgba($default_color, '0.3').';
                }
                #'.$id.'.text-top li > a:hover::before, #'.$id.'.text-bottom li > a:hover::before {
                    box-shadow: 0 0 0 3px '.wwp_vc_breadcrumbs_hex_to_rgba($active_color, '0.3').';
                }
                #'.$id.'.multi-steps li.visited::after {
                    background-color: '.$default_color.';
                }
                #'.$id.'.multi-steps li::after {
                    background: '.$active_color.';
                }
            </style>
        ';

        $add_theme_class = 'multi-steps text-'.$pages_position.'';
    }

    if($theme == "5")
    {
        $output .= '
            <style>
                #'.$id.'.text-top li.visited > *::before, #'.$id.'.text-top li.current > *::before, #'.$id.'.text-bottom li.visited > *::before, #'.$id.'.text-bottom li.current > *::before {
                    background-color: '.$default_color.';
                }
                #'.$id.'.text-top a:hover, .wwp-vc-breadcrumbs.text-bottom a:hover {
                    color: '.$default_color.';
                }
                #'.$id.'.text-top li > *::before, #'.$id.'.text-bottom li > *::before {
                    background-color: ' . $active_color . ';
                }
                #'.$id.'.text-top li.visited > a:hover::before, #'.$id.'.text-bottom li.visited > a:hover::before {
                    box-shadow: 0 0 0 3px '.wwp_vc_breadcrumbs_hex_to_rgba($default_color, '0.3').';
                }
                #'.$id.'.text-top li > a:hover::before, #'.$id.'.text-bottom li > a:hover::before {
                    box-shadow: 0 0 0 3px '.wwp_vc_breadcrumbs_hex_to_rgba($active_color, '0.3').';
                }
                #'.$id.'.multi-steps li.visited::after {
                    background-color: '.$default_color.';
                }
                #'.$id.'.multi-steps li::after {
                    background: '.$active_color.';
                }
            </style>
        ';

        $add_theme_class = 'multi-steps text-'.$pages_position.' count';
    }

    $output .= '<ol class="wwp-vc-breadcrumbs '.$add_theme_class.'" id="'.$id.'">';

    if($show_home == "1")
    {
        $output .= '<li class="visited"><a href="/">Home</a></li>';
    }

    if($show_parent == "1")
    {
        $parents = get_post_ancestors($post->ID);

        krsort($parents);

        foreach($parents as $a_parent_ID)
        {
            $parent = get_post($a_parent_ID);
            $output .= '<li class="visited"><a href="'.get_permalink($parent->ID).'">'.$parent->post_title.'</a></li>';
        }
    }

    $output .= '<li class="current"><span>'.get_the_title().'</span></li>';

    if($show_child == "1")
    {
        wp_reset_postdata();

        $page_child_args = array(
            "post_type"=> "page",
            "post_parent" => $post->ID,
            "orderby" => "menu_order",
            "order" => "ASC"
        );
        $get_page_child = get_posts($page_child_args);

        foreach($get_page_child as $child_post)
        {
            setup_postdata($child_post);

            $output .= '<li><span>'.get_the_title($child_post->ID).'</span></li>';
        }

        wp_reset_postdata();
    }

    $output .= '</ol>';

    return $output;
}