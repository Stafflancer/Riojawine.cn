<?php

add_action('init', 'create_wwp_vc_breadcrumbs_static_item');
add_shortcode('wwp_vc_breadcrumbs_static_item', 'wwp_vc_breadcrumbs_static_item');

function create_wwp_vc_breadcrumbs_static_item()
{
    if(!function_exists('vc_map'))
    {
        return;
    }

    vc_map(array(
        "name" => "Breadcrumb Item",
        "base" => "wwp_vc_breadcrumbs_static_item",
        "as_child" => array("only" => "wwp_vc_breadcrumbs_static"),
        "content_element" => true,
        "icon" => "stat-item",
        "show_settings_on_create" => true,
        "description" => "Breadcrumb item",
        "category" => wwp_vc_breadcrumbs_name,
        "params" => array(
            array(
                "heading" => "Title",
                "type" => "textfield",
                "param_name" => "item_title",
                "value" => "",
                "description" => "Breadcrumb item title",
                "group" => "Settings",
                "admin_label" => true,
            ),

            array(
                "heading" => "Active state",
                "type" => "dropdown",
                "value" => array(
                    "Yes" => 1,
                    "No" => 0
                ),
                "param_name" => "active_state",
                "std" => 0,
                "description" => "Active breadcrumb item",
                "group" => "Settings",
                "admin_label" => true,
            ),

            array(
                "heading" => "Next Page",
                "type" => "dropdown",
                "value" => array(
                    "Yes" => 1,
                    "No" => 0
                ),
                "param_name" => "next_page",
                "std" => 0,
                "description" => "Next page (used in Multi-Steps and Dots)",
                "group" => "Settings",
                "admin_label" => true,
                "dependency" => array("element" => "active_state", "value" => "0"),
            ),

            array(
                "heading" => "Link",
                "type" => "vc_link",
                "param_name" => "item_link",
                "description" => "Breadcrumb Item Link",
                "group" => "Settings",
                "admin_label" => false,
                "dependency" => array("element" => "active_state", "value" => "0"),
            ),
        )
    ));
}

function wwp_vc_breadcrumbs_static_item($atts, $content = null)
{
    global $WWP_BREADCRUMBS_STATIC_SHORTCODE;

    extract(shortcode_atts(array(
        "item_title" => "",
        "active_state" => "0",
        "next_page" => "0",
        "item_link" => "",
    ), $atts));

    $temp_array = array(
        'item_title' => $item_title,
        'active_state' => $active_state,
        'next_page' => $next_page,
        'item_link' => vc_build_link($item_link)
    );

    $WWP_BREADCRUMBS_STATIC_SHORTCODE['breadcrumb'][] = $temp_array;
}