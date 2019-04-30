<?php

// CPT
add_action( 'init', 'bsdchild_cpt_packages', 0 );
function bsdchild_cpt_packages() {

	/** Test custom post type */
	register_post_type( 'packages',
		array(
			'labels' => array(
				'name' => __( 'Event Packages' ),
				'singular_name' => __( 'Package' ),
				'add_new' => __( 'Add Package' ),
				'add_new_item' => __( 'Add a Package' )
			),
			'menu_icon' => 'dashicons-products',
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

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_birthday-packages',
		'title' => 'Event Packages',
		'fields' => array (
			array (
				'key' => 'field_5a7cb299f8bdb',
				'label' => 'Public Title',
				'name' => 'public_title',
				'type' => 'text',
				'instructions' => 'This title is the one that is actually displayed on the front end of the website.',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5a7cba92f8be7',
				'label' => 'Price',
				'name' => 'price',
				'type' => 'repeater',
				'required' => 1,
				'sub_fields' => array (
					array (
						'key' => 'field_5a7cbaa8f8be8',
						'label' => 'Cost',
						'name' => 'cost',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_5a7cbaf5f8be9',
						'label' => 'Cost Breakdown',
						'name' => 'per',
						'type' => 'text',
						'required' => 1,
						'column_width' => '',
						'default_value' => '',
						'placeholder' => 'Per Child',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_5a7cbb11f8bea',
						'label' => 'Note',
						'name' => 'note',
						'type' => 'text',
						'instructions' => 'Minimum Requirements?',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => 1,
				'row_limit' => 1,
				'layout' => 'row',
				'button_label' => 'Add Price',
			),
			array (
				'key' => 'field_5a7cbb6af8bec',
				'label' => 'Meriq - Booking Link',
				'name' => 'link_booking',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5a7cb963f8bdc',
				'label' => 'Featured Package?',
				'name' => 'is_featured',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5a7cb97af8bdd',
				'label' => 'Featured Package Reason',
				'name' => 'featured_cause',
				'type' => 'text',
				'instructions' => '"Most Popular!" or "Best Bargain!" etc.',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5a7cb963f8bdc',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 'Most Popular!',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5a7cb9bcf8bde',
				'label' => 'Primary Features',
				'name' => 'features_primary',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5a7cb9cef8bdf',
						'label' => 'Icon',
						'name' => 'icon',
						'type' => 'select',
						'required' => 1,
						'column_width' => '',
						'choices' => array (
							'arcade' => 'Arcade',
							'bowling' => 'Bowling',
							'bumper-car' => 'Bumper Car',
							'chefs-choice' => 'Chef\'s Choice',
							'clock' => 'Clock',
							'escape' => 'Escape Room',
							'gluten-free' => 'Gluten Free',
							'health-advisory' => 'Health Advisory',
							'healthy-choice' => 'Healthy Choice',
							'hot-spicy' => 'Spicy',
							'laser-tag' => 'Laser Tag',
						),
						'default_value' => '',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_5a7cb9ebf8be0',
						'label' => 'Text',
						'name' => 'text',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => 'X Hours of Fun',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Feature',
			),
			array (
				'key' => 'field_5a7cba15f8be1',
				'label' => 'Food Features',
				'name' => 'features_food',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5a7cba23f8be2',
						'label' => 'Text',
						'name' => 'text',
						'type' => 'text',
						'required' => 1,
						'column_width' => '',
						'default_value' => '',
						'placeholder' => 'Soft drinks',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Feature',
			),
			array (
				'key' => 'field_5a7cba4df8be3',
				'label' => 'Extra Features',
				'name' => 'features_extra',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5a7cba4df8be4',
						'label' => 'Text',
						'name' => 'text',
						'type' => 'text',
						'required' => 1,
						'column_width' => '',
						'default_value' => '',
						'placeholder' => 'Free Shoe Rental',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Feature',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'packages',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'the_content',
				2 => 'excerpt',
				3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'revisions',
				7 => 'author',
				8 => 'format',
				9 => 'featured_image',
				10 => 'categories',
				11 => 'tags',
				12 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}
