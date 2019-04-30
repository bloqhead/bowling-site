<?php
/**
 * Template Name: Locations Template
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['sidebar'] = Timber::get_sidebar( 'sidebar-locations.php' );
$templates = array(
	'views/pages/page-' . $post->post_name . '.twig',
	'views/templates/locations.twig', // Doesn't exist, currently (not a custom layout)
	'views/pages/page.twig',
);
Timber::render( $templates, $context );
