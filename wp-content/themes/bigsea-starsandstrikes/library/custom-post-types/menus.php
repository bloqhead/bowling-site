<?php

// CPT
add_action( 'init', 'bsdchild_cpt_menus', 0 );
function bsdchild_cpt_menus() {

	/** Test custom post type */
	register_post_type( 'menu',
		array(
			'labels' => array(
				'name' => __( 'Menus' ),
				'singular_name' => __( 'Menu' ),
				'add_new' => __( 'Add Menu' ),
				'add_new_item' => __( 'Add a Menu' )
			),
			'menu_icon' => 'dashicons-store',
			'public' => false,
			'has_archive' => false,
			'show_ui' => true,
			'exclude_from_search' => true,
			'supports' => array (
				'title',
				'thumbnail',
				'page-attributes',
				'editor'
			),
		)
    );

    register_taxonomy('menu-restaurant', 'menu', array(
		'hierarchical'      => true,
		'labels'            => array(
            'name'              => 'Restaurants',
            'singular_name'     => 'Restaurant',
        ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'public'            => false,
    ));
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_menu',
		'title' => 'Menu',
		'fields' => array (
			array (
				'key' => 'field_5a7b222e79422',
				'label' => 'Section',
				'name' => 'sections',
				'type' => 'repeater',
				'required' => 1,
				'sub_fields' => array (
					array (
						'key' => 'field_5a7b228c79424',
						'label' => 'Header',
						'name' => 'header',
						'type' => 'repeater',
						'column_width' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_5a7b22ab79425',
								'label' => 'Name',
								'name' => 'name',
								'type' => 'text',
								'required' => 1,
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'none',
								'maxlength' => '',
							),
							array (
								'key' => 'field_5a7b22c279426',
								'label' => 'Sub Menu',
								'name' => 'header_type',
								'type' => 'true_false',
								'instructions' => 'If selected, this section will show header variant #2',
								'column_width' => '',
								'message' => '',
								'default_value' => 0,
							),
						),
						'row_min' => 1,
						'row_limit' => 1,
						'layout' => 'table',
						'button_label' => 'Add Header',
					),
					array (
						'key' => 'field_5a7b236f79428',
						'label' => 'Description',
						'name' => 'description',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'basic',
						'media_upload' => 'no',
					),
					array (
						'key' => 'field_5a7b230479427',
						'label' => 'Menu Items',
						'name' => 'menu_items',
						'type' => 'relationship',
						'column_width' => '',
						'return_format' => 'object',
						'post_type' => array (
							0 => 'menu-item',
						),
						'taxonomy' => array (
							0 => 'all',
						),
						'filters' => array (
							0 => 'search',
						),
						'result_elements' => array (
							0 => 'post_title',
						),
						'max' => '',
					),
				),
				'row_min' => 1,
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Section',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'menu',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				1 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
    register_field_group(array (
        'id' => 'acf_restaurants',
        'title' => 'Restaurants',
        'fields' => array (
            array (
                'key' => 'field_5a79faf5dab4e',
                'label' => 'Logo',
				'name' => 'logo',
				'type' => 'image',
                'save_format' => 'object',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'ef_taxonomy',
                    'operator' => '==',
                    'value' => 'menu-restaurant',
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