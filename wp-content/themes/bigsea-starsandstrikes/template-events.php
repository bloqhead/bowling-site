<?php
/**
 * Template Name: Events Template
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['sidebar'] = Timber::get_sidebar( 'sidebar-events.php' );
$templates = array(
	'views/pages/page-' . $post->post_name . '.twig',
	'views/templates/events.twig',
	'views/pages/page.twig',
);
Timber::render( $templates, $context );
