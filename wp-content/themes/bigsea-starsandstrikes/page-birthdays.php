<?php
/**
 * Birthday Packages page
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
$context['currentLocation'] = $location->getTimberObject();
$context['availableLocations'] = bsdchild_getAllLocations();
$context['packages'] = $location->getBirthdayPackages();

// set a column width based on the package count
$context['packageColumnClass'] = 'grid__col-4';
if ($context['packages']) {
    $packageCount = count($context['packages']);
    foreach ($context['packages'] as $package) {
        if (get_field('is_featured', $package->ID)) {
            $packageCount--;
        }
    }
    if ($packageCount == 2) {
        // Only two, so show both on the same row, fully set.
        $context['packageColumnClass'] = 'grid__col-6';
    }
    else if ($packageCount == 4 || $packageCount % 4 == 0) {
        $context['packageColumnClass'] = 'grid__col-3';
    }
}

// Cleanup
if (is_array($context['packages'])) {
    foreach ($context['packages'] as &$current) {
        $current = new \TimberPost($current);
    }
}
foreach ($context['availableLocations'] as &$currentLocation) {
    if ($currentLocation->ID == $location->ID) {
        $currentLocation->active = 'selected';
    }
}

// Render!
$templates = array(
	'views/pages/page-birthdays.twig',
	'views/pages/page.twig',
);
Timber::render( $templates, $context );
