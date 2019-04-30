<?php
/**
 * Play page sidebar
 *
 * @package  WordPress
 * @subpackage  Timber
 */

$context = Timber::get_context();
$context['sidebar'] = Timber::get_widgets( 'play-sidebar' );
Timber::render( 'views/partials/sidebar.twig', $context );
