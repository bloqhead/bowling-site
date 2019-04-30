<?php

// Attractions widget
class AttractionsWidget extends WP_Widget {

	function __construct() {
        // Instantiate the parent object
        $args = array(
            'description' => 'A list of the Attractions',
        );
		parent::__construct( false, 'Attractions', $args );
	}

	function widget( $args, $instance ) {
		global $post;

		$context = Timber::get_context();
		
		// Widget output
		$attractions = Timber::get_posts(array(
			'post_type' => 'attractions',
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order'	=> 'ASC',
			'meta_query' => array(
				array(
					'key' => 'show',
					'value' => 1,
				),
			),
		));

		if ($attractions) {
			echo $args['before_widget'];

			echo $args['before_title'] . 'Attractions' . $args['after_title'];

			$context['attractions'] = $attractions;
			$templates = array(
				'views/partials/locations-attractions-stacked.twig'
			);
			Timber::render( $templates, $context );

			echo $args['after_widget'];
		}
	}
}