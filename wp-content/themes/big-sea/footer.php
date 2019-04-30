<?php
/**
 * The footer
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$context = Timber::get_context();
if ( ! isset( $context ) ) {
	throw new \Exception( 'Timber context not set in footer.' );
}

$context['content'] = ob_get_contents();
ob_end_clean();

$templates = array( 'views/plugin.twig' );
Timber::render( $templates, $context );
