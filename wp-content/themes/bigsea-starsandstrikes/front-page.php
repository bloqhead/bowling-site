<?php
/**
 * Home
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

setPageFullWidth();

$context = Timber::get_context();
$context['post'] = new TimberPost();

$context['attractions'] = bsdchild_getAllAttractions();
$context['locations'] = bsdchild_getAllLocations();

$location = coralLocation_selectedLocation();
$context['upcomingSpecials'] = $location->getUpcomingSpecials();
$context['featuredPromotions'] = $location->getFeaturedPromotions();

$context['link_viewAll_specials'] = get_permalink(10) . '#section-specials';
$context['link_viewAll_featured'] = get_permalink(10) . '#section-featured';

// Cleanup
if (is_array($context['upcomingSpecials'])) {
    foreach ($context['upcomingSpecials'] as &$current) {
        foreach ($current['special'] as &$currentSpecial) {
            $currentSpecial = new \TimberPost($currentSpecial);
        }
    }
}

if ($context['featuredPromotions']) {
    $context['hasPromotions'] = true;
    foreach ($context['featuredPromotions'] as &$current) {
        $current = new \TimberPost($current);
    }
    $context['primaryFeaturedPromotion'] = $context['featuredPromotions'][0];
    unset($context['featuredPromotions'][0]);
}

$templates = array( 'views/front-page.twig' );
Timber::render( $templates, $context );
