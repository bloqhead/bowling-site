<?php

// CPT
add_action( 'init', 'bsdchild_cpt_menu_items', 0 );
function bsdchild_cpt_menu_items() {

	/** Test custom post type */
	register_post_type( 'menu-item',
		array(
			'labels' => array(
				'name' => __( 'Menu Items' ),
				'singular_name' => __( 'Menu Item' ),
				'add_new' => __( 'Add Menu Item' ),
				'add_new_item' => __( 'Add a Menu Item' )
			),
			'menu_icon' => 'dashicons-carrot',
			'public' => false,
			'show_ui' => true,
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
        'id' => 'acf_menu-items',
        'title' => 'Menu Items',
        'fields' => array (
            array (
                'key' => 'field_5a79f4ea2407a',
                'label' => 'Default Price',
                'name' => 'price',
                'type' => 'text',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '4.99',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_5a79f47724079',
                'label' => 'Notes',
                'name' => 'notes',
                'type' => 'checkbox',
                'choices' => array (
                    'chefs-choice' => 'Chef\'s Choice',
                    'gluten-free' => 'Gluten Free',
                    'health-advisory' => 'Health Advisory',
                    'healthy-choice' => 'Healthy Choice',
                    'hot-spicy' => 'Spicy',
                ),
                'default_value' => '',
                'layout' => 'vertical',
            ),
            array (
                'key' => 'field_5a79f5152407b',
                'label' => 'Add-Ons',
                'name' => 'addons',
                'type' => 'repeater',
                'sub_fields' => array (
                    array (
                        'key' => 'field_5a79f5252407c',
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
                        'key' => 'field_5a79f5582407d',
                        'label' => 'Price',
                        'name' => 'price',
                        'type' => 'text',
                        'instructions' => '(optional)',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '3.00',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'none',
                        'maxlength' => '',
                    ),
                ),
                'row_min' => '',
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Add Option',
            ),
            array (
				'key' => 'field_5a81f9de47514',
				'label' => 'Price Variations',
				'name' => 'price_variations',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5a81f9f647515',
						'label' => 'Location',
						'name' => 'location',
						'type' => 'post_object',
						'required' => 1,
						'column_width' => '',
						'post_type' => array (
							0 => 'locations',
						),
						'taxonomy' => array (
							0 => 'all',
						),
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_5a81fa2547516',
						'label' => 'Price',
						'name' => 'price',
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
						'key' => 'field_5a82058b6dc8d',
						'label' => 'Override Add-Ons?',
						'name' => 'override_addons',
                        'instructions' => 'If checked, will override ALL default options. If no options of are provided in next field, no options will appear on item for this location',
						'type' => 'true_false',
						'column_width' => '',
						'message' => '',
						'default_value' => 0,
					),
					array (
						'key' => 'field_5a81fa3447517',
						'label' => 'Add-Ons',
                        'name' => 'addons',
						'type' => 'repeater',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a82058b6dc8d',
									'operator' => '==',
									'value' => '1',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_5a81fa4c47518',
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
								'key' => 'field_5a81fa5c47519',
								'label' => 'Price',
                                'name' => 'price',
                                'instructions' => '(optional)',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'none',
								'maxlength' => '',
							),
						),
						'row_min' => 0,
						'row_limit' => '',
						'layout' => 'table',
						'button_label' => 'Add Row',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Variation',
			),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'menu-item',
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
