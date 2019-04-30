<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Big_Sea
 */

$context = Timber::get_context();
$context['title'] = 'Search results for '. get_search_query();
$context['posts'] = Timber::get_posts();
$context['pagination'] = Timber::get_pagination();
$context['sidebar'] = Timber::get_sidebar( 'sidebar.php' );
$templates = array(
	'views/search.twig',
	'views/archives/archive.twig',
	'views/index.twig'
);
Timber::render( $templates, $context );
