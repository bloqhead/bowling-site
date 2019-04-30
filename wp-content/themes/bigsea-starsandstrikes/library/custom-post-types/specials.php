<?php

// CPT
add_action( 'init', 'bsdchild_cpt_specials', 0 );
function bsdchild_cpt_specials() {

	/** Test custom post type */
	register_post_type( 'specials',
		array(
			'labels' => array(
				'name' => __( 'Weekly Specials' ),
				'singular_name' => __( 'Special' ),
				'add_new' => __( 'Add Special' ),
				'add_new_item' => __( 'Add a Special' )
			),
			'menu_icon' => 'dashicons-star-filled',
			'public' => true,
			'has_archive' => false,
			'supports' => array (
				'title',
				'thumbnail',
				'page-attributes',
				'editor'
			),
		)
	);

}

// ACF
if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_specials_additional',
        'title' => 'Specials',
        'fields' => array (
            array (
                'key' => 'field_5a79f1f0d46a1',
                'label' => 'Hours',
                'name' => 'hours',
                'type' => 'repeater',
                'sub_fields' => array (
                    array (
                        'key' => 'field_5a79f1f0d46a2',
                        'label' => 'Open',
                        'name' => 'time_open',
                        'type' => 'text',
                        'required' => 1,
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '10:00 am',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'none',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_5a79f1f0d46a3',
                        'label' => 'Close',
                        'name' => 'time_close',
                        'type' => 'text',
                        'required' => 1,
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '10:00 pm',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'none',
                        'maxlength' => '',
                    ),
                ),
                'row_min' => 0,
                'row_limit' => 1,
                'layout' => 'table',
                'button_label' => 'Add Hours',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'specials',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'promotions',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
}