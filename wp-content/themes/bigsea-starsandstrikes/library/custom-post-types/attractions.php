<?php

// CPT
add_action( 'init', 'bsdchild_cpt_attractions', 0 );
function bsdchild_cpt_attractions() {

	/** Test custom post type */
	register_post_type( 'attractions',
		array(
			'labels' => array(
				'name' => __( 'Attractions' ),
				'singular_name' => __( 'Attraction' ),
				'add_new' => __( 'Add Attraction' ),
				'add_new_item' => __( 'Add a Attraction' )
			),
			'menu_icon' => 'dashicons-tickets-alt',
			'public' => true,
			'has_archive' => true,
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
		'id' => 'acf_attractions',
		'title' => 'Attractions',
		'fields' => array (
			array (
                'key' => 'field_5a79f3f8622b0',
                'label' => 'Summary/Excerpt',
                'name' => 'summary',
                'type' => 'textarea',
                'instructions' => 'Used on Location Landing Pages and anywhere content needs to be shortened.',
                'default_value' => '',
                'placeholder' => '',
                'rows' => 4,
                'maxlength' => '',
            ),
			array (
				'key' => 'field_5a79f261157b1',
				'label' => 'Icon',
				'name' => 'icon',
				'type' => 'select',
				'required' => 1,
				'choices' => array (
					'arcade' => 'Arcade',
					'bowling' => 'Bowling',
					'bumper-car' => 'Bumper Car',
					'escape' => 'Escape Room',
					'laser-tag' => 'Laser Tag',
					'virtual-reality' => 'Virtual Reality'
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a79f6bdea4d1',
				'label' => 'Show in Attractions',
				'name' => 'show',
				'type' => 'true_false',
				'instructions' => 'Show on Attractions List page? If unselected, the attraction will show up as an icon in the locations list view, but will not show up on the "Attractions" page.',
				'message' => '',
				'default_value' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'attractions',
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
