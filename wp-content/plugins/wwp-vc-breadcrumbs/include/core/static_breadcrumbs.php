<?php

add_action('init', 'create_wwp_vc_breadcrumbs_static');
add_shortcode('wwp_vc_breadcrumbs_static', 'wwp_vc_breadcrumbs_static');

function create_wwp_vc_breadcrumbs_static()
{
    if(!function_exists('vc_map'))
    {
        return;
    }

    vc_map(array(
        "name" => "Static Breadcrumb",
        "as_parent" => array("only" => "wwp_vc_breadcrumbs_static_item"),
        "base" => "wwp_vc_breadcrumbs_static",
        'content_element' => true,
        'show_settings_on_create' => true,
        "icon" => "stat",
        "js_view" => 'VcColumnView',
        "description" => "Add static breadcrumbs",
        "category" => wwp_vc_breadcrumbs_name,
        "params" => array(
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

function wwp_vc_breadcrumbs_static($atts, $content = null)
{
    global $WWP_BREADCRUMBS_STATIC_SHORTCODE;

    $WWP_BREADCRUMBS_STATIC_SHORTCODE['breadcrumb'] = array();

    extract(shortcode_atts(array(
        "theme" => "0",
        "custom_separator_type" => "0",
        "text_separator" => "",
        "fa_icon_separator" => "",
        "image_separator" => "",
        "pages_position" => "top",
        "custom_styling" => "no",
        "default_color" => "#007C46",
        "active_color" => "#AFD236"
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

    $breadcrumb = do_shortcode( $content );

    foreach($WWP_BREADCRUMBS_STATIC_SHORTCODE['breadcrumb'] as $breadcrumb_item)
    {
        if($breadcrumb_item['active_state'] == 0 && $breadcrumb_item['next_page'] == 0)
        {
            if($breadcrumb_item['item_link']['url'] != '')
            {
                $output .= '<li class="visited"><a href="'.$breadcrumb_item['item_link']['url'].'">'.$breadcrumb_item['item_title'].'</a></li>';
            }
            else
            {
                $output .= '<li class="visited"><span>'.$breadcrumb_item['item_title'].'</span></li>';
            }
        }
        if($breadcrumb_item['active_state'] == 1 && $breadcrumb_item['next_page'] == 0)
        {
            $output .= '<li class="current"><span>'.$breadcrumb_item['item_title'].'</span></li>';
        }
        if($breadcrumb_item['next_page'] == 1)
        {
            if($breadcrumb_item['item_link']['url'] != '')
            {
                $output .= '<li><a href="'.$breadcrumb_item['item_link']['url'].'">'.$breadcrumb_item['item_title'].'</a></li>';
            }
            else
            {
                $output .= '<li><span>'.$breadcrumb_item['item_title'].'</span></li>';
            }
        }
    }

    $output .= '</ol>';

    return $output;
}

if(class_exists('WPBakeryShortCodesContainer'))
{
    class WPBakeryShortCode_wwp_vc_breadcrumbs_static extends WPBakeryShortCodesContainer {}
}
if(class_exists('WPBakeryShortCode'))
{
    class WPBakeryShortCode_wwp_vc_breadcrumbs_static_item extends WPBakeryShortCode {}
}