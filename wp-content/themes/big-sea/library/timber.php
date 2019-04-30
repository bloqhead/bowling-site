<?php

/**
 * Timber additions
 */

/** Add to context */
class BigSeaTimber extends TimberSite {
	// add to context
	function __construct() {
		add_filter( 'timber_context', array( $this, 'bigsea_add_to_context' ) );
		parent::__construct();
	}

	// Timber context additions
	function bigsea_add_to_context( $context ) {
		// main menu
		$context['main_menu'] = new TimberMenu( 'primary' );
		// footer menu
		$context['footer_menu'] = new TimberMenu( 'footer' );
		// shorthand for grabbing site attributes
		$context['site'] = $this;

		return $context;
	}
}
new BigSeaTimber();