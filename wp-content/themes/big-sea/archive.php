<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Big_Sea
 */

$context = Timber::get_context();
$context['sidebar'] = Timber::get_sidebar( 'sidebar.php' );
$templates = array( 
	'views/archives/archive-' . get_post_type() . '.twig',
	'views/archives/archive.twig', 
	'views/index.twig',
);

$context['title'] = 'Archive';
if ( is_day() ) {
	$context['title'] = 'Archive: '.get_the_date( 'D M Y' );
} else if ( is_month() ) {
	$context['title'] = 'Archive: '.get_the_date( 'M Y' );
} else if ( is_year() ) {
	$context['title'] = 'Archive: '.get_the_date( 'Y' );
} else if ( is_tag() ) {
	$context['title'] = single_tag_title( '', false );
} else if ( is_category() ) {
	$context['title'] = single_cat_title( '', false );
	array_unshift( $templates, 'views/archives/archive-' . get_query_var( 'cat' ) . '.twig' );
} else if ( is_post_type_archive() ) {
	$context['title'] = post_type_archive_title( '', false );
}

$context['posts'] = Timber::get_posts();
$context['pagination'] = Timber::get_pagination();

Timber::render( $templates, $context );
