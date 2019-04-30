<?php
/**
 * Template Name: Play Template
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['sidebar'] = Timber::get_sidebar( 'sidebar-play.php' );
$templates = array(
	'views/pages/page-' . $post->post_name . '.twig',
	'views/templates/play.twig', // Doesn't exist, currently (not a custom layout)
	'views/pages/page.twig',
);
Timber::render( $templates, $context );
