<?php

/**
 * Advanced Custom Fields
 * 
 *  After ACF fields are set in stone, export and include in this file.
 *
 * @link https://www.advancedcustomfields.com/resources/register-fields-via-php/
 *
 * @package  Big_Sea
 */

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Location Landing Page Settings',
		'menu_title'	=> 'Location Landing Page',
		'menu_slug' 	=> 'location-landing-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_birthday_page',
		'title' => 'Birthday Page',
		'fields' => array (
			array (
				'key' => 'field_5a84a05582d10',
				'label' => 'Highlights Header',
				'name' => 'highlights_header',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5a84a06e82d11',
				'label' => 'Highlights',
				'name' => 'highlights',
				'type' => 'repeater',
				'required' => 1,
				'sub_fields' => array (
					array (
						'key' => 'field_5a84a08e82d12',
						'label' => 'Text',
						'name' => 'text',
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
						'key' => 'field_5a84a09b82d13',
						'label' => 'Caveat',
						'name' => 'caveat',
						'type' => 'text',
						'instructions' => 'If there\'s a caveat, include the symbol here.',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '*',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
				),
				'row_min' => 1,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Highlight',
			),
			array (
				'key' => 'field_5a84a0c182d14',
				'label' => 'Highlight Caveats',
				'name' => 'caveats',
				'type' => 'repeater',
				'instructions' => 'Any Caveats pointed out above in the "Highlights", include the details here.',
				'sub_fields' => array (
					array (
						'key' => 'field_5a84a0cb82d15',
						'label' => 'Symbol',
						'name' => 'symbol',
						'type' => 'text',
						'required' => 1,
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '*',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
					array (
						'key' => 'field_5a84a0f282d16',
						'label' => 'Details',
						'name' => 'details',
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
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Caveat Details',
            ),
            array (
                'key' => 'field_5a84a05582d17',
                'label' => 'Party Package Header',
                'name' => 'package_header',
                'instructions' => 'At the end of this text, a dropdown of available Locations will be automatically included',
                'type' => 'text',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_5a84a05582d18',
                'label' => 'Sub Section',
                'name' => 'birthday_sub_section',
                'instructions' => 'At the bottom of the page, there is room for more content. This goes below the Package Options',
                'type' => 'wysiwyg',
                'required' => 1,
                'default_value' => '',
                'toolbar' => 'basic',
            ),
		),
		'location' => array (
			array (
				array (
					'param' => 'page',
					'operator' => '==',
					'value' => '6',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-birthdays-landing.php',
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

	register_field_group(array (
		'id' => 'acf_birthday-package-fields',
		'title' => 'Package Fields',
		'fields' => array (
			array (
				'key' => 'field_5a85e41fa90fe',
				'label' => 'Event Packages',
				'instructions' => 'If a package is selected, it will show up on the Sidebar, above the general sidebar section, for any page.',
				'name' => 'birthday_packages',
				'type' => 'relationship',
				'return_format' => 'object',
				'post_type' => array (
					0 => 'packages',
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
				'max' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
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
	register_field_group(array (
		'id' => 'acf_locations-landing-page',
		'title' => 'Locations Landing Page',
		'fields' => array (
			array (
				'key' => 'field_5a85e3e378af8',
				'label' => 'Specials Headline',
				'name' => 'headline_specials',
				'type' => 'text',
				'required' => 1,
				'default_value' => 'Daily Specials',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5a85e2bc58fad',
				'label' => 'Attractions Headline',
				'name' => 'headline_attractions',
				'type' => 'text',
				'required' => 1,
				'default_value' => 'More to Enjoy!',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5a85e17d58fa3',
				'label' => 'Food "Attraction"',
				'name' => 'attraction_food',
				'type' => 'repeater',
				'instructions' => 'Only appears if the Location has a restaurant. The link is dynamic and will automatically go to the restaurant\'s menu at /eat',
				'required' => 1,
				'sub_fields' => array (
					array (
						'key' => 'field_5a85e1b958fa4',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'required' => 1,
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_5a85e1f058fa5',
						'label' => 'Headline',
						'name' => 'title',
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
						'key' => 'field_5a85e20858fa6',
						'label' => 'Description',
						'name' => 'description',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => 2,
						'formatting' => 'br',
					),
				),
				'row_min' => 1,
				'row_limit' => 1,
				'layout' => 'row',
				'button_label' => 'Add',
			),
			array (
				'key' => 'field_5a85e23458fa8',
				'label' => 'Party CTA',
				'name' => 'party_cta',
				'type' => 'repeater',
				'required' => 1,
				'sub_fields' => array (
					array (
						'key' => 'field_5a85e24b58fa9',
						'label' => 'Headline',
						'name' => 'title',
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
						'key' => 'field_5a85e25a58faa',
						'label' => 'Description',
						'name' => 'description',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => 2,
						'formatting' => 'br',
					),
					array (
						'key' => 'field_5a85e29058fab',
						'label' => 'Button Link',
						'name' => 'button_link',
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
						'key' => 'field_5a85e29a58fac',
						'label' => 'Button Text',
						'name' => 'button_text',
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
				),
				'row_min' => 1,
				'row_limit' => 1,
				'layout' => 'row',
				'button_label' => 'Add',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'location-landing-settings',
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

	register_field_group(array (
		'id' => 'acf_globals',
		'title' => 'Global Variables',
		'fields' => array (
			array (
				'key' => 'field_5a85e369cd9c9',
				'label' => 'Default Masthead',
				'name' => 'masthead',
				'instructions' => 'When we are unable to find an image, fall back to this image for the masthead.',
				'type' => 'image',
				'required' => 1,
				'column_width' => '',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array(
				'key' => 'field_5a85e369cd9ca',
				'label' => 'Blackout Notice',
				'name' => 'notice_blackouts',
				'type' => 'text',
				'instructions' => 'When Specials are displayed on details page, this notice is shown.',
				'required' => 1,
				'default_value' => 'Black out dates may apply.',

			)
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	register_field_group(array (
		'id' => 'acf_social-networks',
		'title' => 'Social Networks',
		'fields' => array (
			array (
				'key' => 'field_5a85e369cd9c6',
				'label' => 'Facebook',
				'name' => 'link_facebook',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5a85e374cd9c7',
				'label' => 'Twitter',
				'name' => 'link_twitter',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5a85e384cd9c8',
				'label' => 'Instagram',
				'name' => 'link_instagram',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	register_field_group(array (
		'id' => 'acf_additional-images',
		'title' => 'Additional Images',
		'fields' => array (
			array (
				'key' => 'field_5a996ce36ba64',
				'label' => 'Masthead',
				'name' => 'masthead',
				'type' => 'image',
				'instructions' => 'If included, will override "Featured Image" for the masthead.',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '!=',
					'value' => 'menu-item',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'post_type',
					'operator' => '!=',
					'value' => 'menu',
					'order_no' => 1,
					'group_no' => 0,
				),
				array (
					'param' => 'post_type',
					'operator' => '!=',
					'value' => 'packages',
					'order_no' => 2,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
