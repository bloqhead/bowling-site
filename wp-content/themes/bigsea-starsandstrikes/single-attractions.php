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

// Set Context
$context['post'] = $post;
$context['sidebar'] = Timber::get_sidebar( 'sidebar-play.php' );

// Get all Locations
$locations = bsdchild_getAllLocations();
$context['hasLocations'] = false;
$matchedLocations = [];
// Find out if they support this attraction.
foreach ($locations as $location) {
	foreach ($location->attractions as $attraction) {
		if ($attraction == $post->ID) {
			$context['hasLocations'] = true;
			$matchedLocations[] = "<a href='{$location->link}'>{$location->name}</a>";
			break;
		}
	}
}
$context['availableAtLocations'] = join(', ', $matchedLocations);

// Render
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
