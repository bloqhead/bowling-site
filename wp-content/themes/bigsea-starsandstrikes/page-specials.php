<?php
/**
 * Eat/Menu page
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

setPageFullWidth();

$location = coralLocation_selectedLocation();
if (isset($_GET['switch']) && $_GET['switch'] != $location->slug) {
    // get location by ID and assign it instead.
    $location = CoralLocationModel::fromSlug($_GET['switch']);
}
$location = CoralLocationModel::fromWPPost($location->object);

$context = Timber::get_context();
$post = new TimberPost();

// Set the Context
$context['post'] = $post;
$context['availableLocations'] = bsdchild_getAllLocations();
$context['currentLocation'] = $location->getTimberObject();
$specials = $location->getSpecials();
$context['featuredPromotions'] = $location->getFeaturedPromotions();

// Cleanup
if (is_array($specials)) {
    $context['dailySpecials'] = array();
    foreach ($specials as $current) {
        $temp = $current;
        foreach ($current['special'] as $special) {
            $temp['special'] = array();
            $temp['special'][] = new \TimberPost($special);
            $context['dailySpecials'][] = $temp;
        }
    }
    unset($temp, $specials);
}
if ($context['featuredPromotions']) {
    $context['hasPromotions'] = true;
    foreach ($context['featuredPromotions'] as &$current) {
        $current = new \TimberPost($current);
    }
    $context['primaryFeaturedPromotion'] = $context['featuredPromotions'][0];
    unset($context['featuredPromotions'][0]);
}

foreach ($context['availableLocations'] as &$currentLocation) {
    if ($currentLocation->ID == $location->ID) {
        $currentLocation->active = 'selected';
    }
}

// Render!
$templates = array(
    'views/pages/page-specials.twig',
    'views/pages/page.twig',
);
Timber::render( $templates, $context );
