<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5a361d1308f98',
        'title' => esc_html__('WooCommerce', 'soprano-ecommerce'),
        'fields' => array(
            array(
                'key' => 'field_5a361e2930610',
                'label' => esc_html__('General', 'soprano-ecommerce'),
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_5a361e3b30611',
                'label' => esc_html__('Products per page in listings', 'soprano-ecommerce'),
                'name' => 'products_per_page',
                'type' => 'number',
                'instructions' => esc_html__('How much products should be displayed at listings pages such as search or category listing. Leave empty to use WordPress default.', 'soprano-ecommerce'),
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 9,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => 1,
                'max' => '',
                'step' => 1,
            ),
            array(
                'key' => 'field_5a361ea830612',
                'label' => esc_html__('Related products count', 'soprano-ecommerce'),
                'name' => 'related_products_count',
                'type' => 'number',
                'instructions' => esc_html__('How much products should be showcased as related on single product page.', 'soprano-ecommerce'),
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 3,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => 0,
                'max' => '',
                'step' => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'sp-theme-extras-options',
                ),
            ),
        ),
        'menu_order' => 20,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));

endif;