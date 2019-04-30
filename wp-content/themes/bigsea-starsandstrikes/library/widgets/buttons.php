<?php

// Buttons widget
class ButtonsWidget extends WP_Widget {

	function __construct() {
        // Instantiate the parent object
        $args = array(
            'description' => 'Display a Yellow Button',
        );
		parent::__construct( false, 'Button', $args );
    }

    function update( $new_instance, $old_instance ) {
        $instance                    = $old_instance;
        $instance['title']           = strip_tags( $new_instance['title'] );
        $instance['url']             = $new_instance['url'];
        $instance['window']          = isset($new_instance['window']) ? $new_instance['window'] : '';
        $instance['icon']            = $new_instance['icon'];
        $instance['icon-placement']  = isset($new_instance['icon-placement']) ? $new_instance['icon-placement'] : 'after';

        return $instance;
    }
    
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => 'Go to Google', 'url' => 'https://google.com' ) );
        if (!isset($instance['icon'])) {
            $instance['icon'] = '';
            $instance['icon-placement'] = 'after';
        }
    ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo 'Button Text'; ?>:</label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:90%;" />
        </p>
        <p>
            <label for="<?php echo absint( $this->get_field_id( 'url' ) ); ?>"><?php echo 'URL'; ?>:</label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" value="<?php echo esc_attr( $instance['url'] ); ?>" style="width:90%;" />
        </p>
        <p>
            <?php $selected = (isset($instance['window']) && $instance['window'] == '_blank' ? 'checked' : '')?>
            <label for="<?php echo absint( $this->get_field_id( 'window' ) ); ?>"><?php echo 'Open in a New Window?'; ?>:</label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'window' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'window' ) ); ?>" value="_blank" <?php echo $selected; ?> type="checkbox" />
        </p>
        <p>
            <label for="<?php echo absint( $this->get_field_id( 'icon' ) ); ?>"><?php echo 'Icon'; ?>:</label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>" value="<?php echo esc_attr( $instance['icon'] ); ?>" style="width:90%;" />
        </p>
        <p class="small">For example, 'arrow-right' ... See <a href="Font Awesome" target="_blank">Font Awesome</a> for possibilities. If no icon, leave blank</p>
        <p>
            <?php $selected = (isset($instance['icon-placement']) && $instance['icon-placement'] == 'before' ? 'checked' : '')?>
            <label for="<?php echo absint( $this->get_field_id( 'icon-placement' ) ); ?>"><?php echo 'Icon Before Text?'; ?>:</label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'icon-placement' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon-placement' ) ); ?>" value="before" <?php echo $selected; ?> type="checkbox" />
        </p>

    <?php
    }

	function widget( $args, $instance ) {
        $before = '';
        $after = '';
        $icon = '';
        if (!isset($instance['icon'])) {
            $instance['icon'] = '';
            $instance['icon-placement'] = '';
        }

        if ($instance['icon'] != '') {
            $icon = "<i class=\"fas fa-{$instance['icon']}\"></i>";
        }
        
        ${$instance['icon-placement']} = $icon;
        $content = trim("{$before} {$instance['title']} {$after}");

        echo "
        <section class=\"button-widget\">
            <p>
                <a href=\"{$instance['url']}\" target=\"{$instance['window']}\" class=\"btn btn--block\">
                    {$content}
                </a>
            </p>
        </section>
        ";
	}
}