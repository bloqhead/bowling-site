<?php

// CPT
add_action( 'init', 'bsdchild_cpt_promotions', 0 );
function bsdchild_cpt_promotions() {

	/** Test custom post type */
	register_post_type( 'promotions',
		array(
			'labels' => array(
				'name' => __( 'Promotions' ),
				'singular_name' => __( 'Promotion' ),
				'add_new' => __( 'Add Promotion' ),
				'add_new_item' => __( 'Add a Promotion' )
			),
			'menu_icon' => 'dashicons-megaphone',
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