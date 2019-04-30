<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Big_Sea
 */

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$templates = array( 'views/404.twig' );
Timber::render( $templates, $context );
