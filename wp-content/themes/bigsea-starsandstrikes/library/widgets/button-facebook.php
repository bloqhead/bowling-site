<?php

// FacebookButton widget
class FacebookButtonWidget extends WP_Widget {

	function __construct() {
        // Instantiate the parent object
        $args = array(
            'description' => 'Displays a link to the Facebook URL of a location (either the active location, or the page location if on the landing page)',
        );
		parent::__construct( false, 'Facebook Button', $args );
	}

	function update( $new_instance, $old_instance ) {
        $instance                    = $old_instance;
		$instance['title']           = strip_tags( $new_instance['title'] );
		$instance['icon']            = $new_instance['icon'];
        $instance['icon-placement']  = isset($new_instance['icon-placement']) ? $new_instance['icon-placement'] : 'after';

        return $instance;
    }

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Follow Us on Facebook' ) );
		if (!isset($instance['icon-placement'])) {
            $instance['icon-placement'] = 'after';
            $instance['icon'] = 'arrow-right';
		}
		
		if ($instance['icon'] == '') {
            $instance['icon'] = 'arrow-right';
		}
    ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo 'Button Text'; ?>:</label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:90%;" />
		</p>
		<p>
            <label for="<?php echo absint( $this->get_field_id( 'icon' ) ); ?>"><?php echo 'Icon'; ?>:</label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>" value="<?php echo esc_attr( $instance['icon'] ); ?>" style="width:90%;" />
		</p>
		<p class="small">For example, 'arrow-right' ... See <a href="Font Awesome" target="_blank">Font Awesome</a> for possibilities. Defaults to 'arrow-right'. Can't be blank</p>
		<p>
            <?php $selected = (isset($instance['icon-placement']) && $instance['icon-placement'] == 'before' ? 'checked' : '')?>
            <label for="<?php echo absint( $this->get_field_id( 'icon-placement' ) ); ?>"><?php echo 'Icon Before Text?'; ?>:</label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'icon-placement' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon-placement' ) ); ?>" value="before" <?php echo $selected; ?> type="checkbox" />
        </p>
    <?php
    }

	function widget( $args, $instance ) {
		global $post;
		if (!isset($instance['icon-placement'])) {
			$instance['icon-placement'] = 'after';
			$instance['icon'] = 'arrow-right';
		}

		if ($instance['icon'] == '') {
            $instance['icon'] = 'arrow-right';
		}

		$before = '';
        $after = '';
        $icon = "<i class=\"fas fa-{$instance['icon']}\"></i>";

		if ($post->post_type == 'locations') {
			$location = CoralLocationModel::fromWPPost(get_post($post->ID));
		}
		else {
			$location = coralLocation_selectedLocation();
		}

		$facebookURL = get_field('external_link_facebook', $location->ID);

		if (!$facebookURL) {
			$facebookURL = get_field('link_facebook', 'options');
		}

		${$instance['icon-placement']} = $icon;
		$content = trim("{$before} {$instance['title']} {$after}");

		echo "
		<section class=\"button-widget\">
			<p>
				<a href=\"{$facebookURL}\" target=\"_blank\" class=\"btn btn--block\">
					{$content}
				</a>
			</p>
		</section>
		";
	}
}
