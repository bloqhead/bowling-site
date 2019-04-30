<?php
/**
 * Events page sidebar
 *
 * @package  WordPress
 * @subpackage  Timber
 */

$context = Timber::get_context();
$context['sidebar'] = Timber::get_widgets( 'events-sidebar' );
Timber::render( 'views/partials/sidebar.twig', $context );
