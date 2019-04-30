<?php

// CallUsButton widget
class CallUsButtonWidget extends WP_Widget {

	function __construct() {
        // Instantiate the parent object
        $args = array(
            'description' => 'Displays the phone number of either the active location, or the page location if on the details page.',
        );
		parent::__construct( false, 'Call Us Button', $args );
	}

	function update( $new_instance, $old_instance ) {
        $instance                    = $old_instance;
        $instance['title']           = strip_tags( $new_instance['title'] );

        return $instance;
    }

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Call {{phone}} to get started.' ) );
		?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo 'Button title'; ?>:</label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:90%;" />
			</p>
			<p><em>Add {{phone}} to the text above to include a link to the phone number.</em></p>
		<?php
	}

	function widget( $args, $instance ) {
		global $post;

		if ($post->post_type == 'locations') {
			$location = CoralLocationModel::fromWPPost(get_post($post->ID));
		}
		else {
			$location = coralLocation_selectedLocation();
		}

		$phoneNumber = get_field('phone_number', $location->ID);
		$parsedPhoneNumber = phone_href($phoneNumber);

		$title = str_replace('{{phone}}', "<a href=\"tel:{$parsedPhoneNumber}\">{$phoneNumber}</a>", $instance['title']);

		echo "
			<p><div class=\"alert alert--has-icon\" role=\"alert\">
				<div class=\"alert__icon\">
					<i class=\"fas fa-phone\"></i>
				</div>
				<div class=\"alert__content\">
					<p>{$title}</p>
				</div>
			</div></p>
		";
	}
}
