<?php

// LocationNotice widget
class LocationNoticeWidget extends WP_Widget {

	function __construct() {
        // Instantiate the parent object
        $args = array(
            'description' => 'If the active/current location has a notice, display it.',
        );
		parent::__construct( false, 'Location Notice', $args );
	}

	public function form( $instance ) {
		echo '<p class="no-options-widget">Only on Location Landing Pages, shows notice, if any, of the current Location.</p>';
		return 'noform';
	}

	function widget( $args, $instance ) {
		global $post;

		if ($post->post_type != 'locations') return;

		$location = CoralLocationModel::fromWPPost(get_post($post->ID));
		$message = $location->getNotice();

		if (!$message || trim($message) == '') return;

		echo "
			<div class='card card--notice'>
			  <div class='card__inner'>
			    <header class='card__header'>
			      <h3 class='card__title'>
							<i class='fas fa-exclamation'></i> Notice
			      </h3>
			    </header>
			    <div class='card__content'>
			      <p>{$message}</p>
			    </div>
			  </div>
			</div> <!-- .card -->
		";
	}
}
