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
$context['sidebar'] = Timber::get_sidebar( 'sidebar-promotions.php' );

// Get all Locations
$locations = bsdchild_getAllLocations();
$context['hasLocations'] = false;
$matchedLocations = [];
foreach ($locations as $location) {
	$specials = get_field('specials', $location->ID);
	foreach ( $specials as $special) {
		foreach ($special['special'] as $currentSpecial) {
			if ($currentSpecial->ID == $post->ID) {
				$context['hasLocations'] = true;
				$currentMatch = "<a href='{$location->link}'>{$location->name}</a>";
				if (!in_array($currentMatch, $matchedLocations)) {
					$matchedLocations[] = $currentMatch;
				}
				break;
			}
		}
	}
	$promotions = get_field('featured', $location->ID);
	if ($promotions) {
		foreach ($promotions as $promotion) {
			if ($promotion->ID == $post->ID) {
				$context['hasLocations'] = true;
				$currentMatch = "<a href='{$location->link}'>{$location->name}</a>";
				if (!in_array($currentMatch, $matchedLocations)) {
					$matchedLocations[] = $currentMatch;
				}
				break;
			}
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
