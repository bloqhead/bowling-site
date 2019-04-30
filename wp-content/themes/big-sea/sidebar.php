<?php
/**
 * The Template for displaying the sidebar
 *
 * @package  WordPress
 * @subpackage  Timber
 */

$context = Timber::get_context();
$context['sidebar'] = Timber::get_widgets( 'primary' );
Timber::render( 'views/partials/sidebar.twig', $context );
