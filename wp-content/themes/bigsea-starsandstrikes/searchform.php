<?php
/**
 * Search form
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$context = Timber::get_context();
$context['post'] = new TimberPost();

$templates = array( 'views/searchform.twig' );
Timber::render( $templates, $context );
