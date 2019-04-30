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
$location = CoralLocationModel::fromWPPost(get_post($post->ID));
$callToActions = $location->getCTAs();

// Set Context
$context['post'] = $post;
$context['sidebar'] = Timber::get_sidebar( 'sidebar-locations.php' );
$context['dailySpecials'] = $location->getSpecials();
$context['attractions'] = $location->getAttractions();

// Location Landing Page Globals
$context['party_cta'] = get_field('party_cta', 'options');
$context['headline_specials'] = get_field('headline_specials', 'options');
$context['headline_attractions'] = get_field('headline_attractions', 'options');
$context['attraction_food'] = get_field('attraction_food', 'options');

// Cleanup
if (is_array($context['dailySpecials'])) {
    foreach ($context['dailySpecials'] as &$current) {
		foreach ($current['special'] as &$special) {
        	$special = new \TimberPost($special);
		}
	}
}
if (is_array($context['attractions'])) {
    foreach ($context['attractions'] as &$current) {
        $current = new \TimberPost($current);
    }
}
if (is_array($callToActions)) {
	foreach ($callToActions as &$current) {
		$current['image'] = new \TimberImage($current['image']);
	}
	$context['cta_top'] = array_slice($callToActions, 0, 2);
	$context['cta_bottom'] = array_slice($callToActions, 2, 2);
}

// Render
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
