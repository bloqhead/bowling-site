<?php
/**
 * The Template for displaying all single posts
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$context['sidebar'] = Timber::get_sidebar( 'sidebar.php' );

if ( post_password_required( $post->ID ) ) {
	/** load the password-protected template if needed */
	Timber::render( 'views/singles/single-password.twig', $context );
}
else {
	Timber::render(
		array(
			/** look for an ID-specific template first... */
			'views/singles/single-' . $post->ID . '.twig',
			/** if there isn't one, look for a post type-specific one... */
			'views/singles/single-' . $post->post_type . '.twig',
			/** if none of the above match, fall back to the default template */
			'views/singles/single.twig'
		), $context
	);
}
