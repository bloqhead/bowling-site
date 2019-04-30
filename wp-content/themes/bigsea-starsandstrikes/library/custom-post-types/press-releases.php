<?php

// CPT
add_action( 'init', 'bsdchild_cpt_press', 0 );
function bsdchild_cpt_press() {

	/** Test custom post type */
	register_post_type( 'press',
		array(
			'labels' => array(
				'name' => __( 'Press Releases' ),
				'singular_name' => __( 'Press Release' ),
				'add_new' => __( 'Add Press Release' ),
				'add_new_item' => __( 'Add a Press Release' )
			),
			'menu_icon' => 'dashicons-testimonial',
			'public' => true,
			'has_archive' => true,
			'supports' => array (
				'title',
				'thumbnail',
				'editor'
			),
		)
    );
}

// ACF