<?php
/**
 * Locations sidebar
 *
 * @package  WordPress
 * @subpackage  Timber
 */

$context = Timber::get_context();
$context['sidebar'] = Timber::get_widgets( 'locations-sidebar' );
Timber::render( 'views/partials/sidebar.twig', $context );
