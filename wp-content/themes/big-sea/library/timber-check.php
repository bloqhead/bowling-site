<?php

/**
 * Initiate the Timber plugin
 */

add_action( 'init', 'bsd_timber_check' );
function bsd_timber_check() {
	if ( ! class_exists( 'Timber' ) ) {
		/** display an error on WP admin */
		add_action( 'admin_notices', function() { ?>
			<div class="error">
				<p>
					Timber not activated. Make sure you activate the plugin in <a href=" <?php echo esc_url( admin_url( 'plugins.php#timber' ) ); ?>"> <?php echo esc_url( admin_url( 'plugins.php') ); ?></a>
				</p>
			</div>
		<?php });
		/**
		 * load a fallback page on the front end
		 * telling the user to install and activate
		 * the Timber plugin
		 */
		add_filter('template_include', function($template) {
			return get_template_directory() . '/no-timber.html';
		});
	}
	else {
		/** init Timber */
		$timber = new \Timber\Timber();
	}
}
