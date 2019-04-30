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
$context['currentLocation'] = $location->getTimberObject();
$context['availableLocations'] = bsdchild_getAllLocations();
$menu = $location->getParsedMenu();
$context['restaurant'] = new \TimberTerm($location->getRestaurant(), 'menu-restaurant');

// Cleanup
$parsedMenuSections = [];
$currentArrayItem = -1;
foreach ($menu->sections as &$current) {
    if (is_array($current['menu_items'])) {
        foreach ($current['menu_items'] as &$item) {
            $item = new \TimberPost($item);
        }
    }

    // Set parentage.
    if ($current['header'][0]['header_type'] == true && $currentArrayItem >= 0) {
        $parsedMenuSections[$currentArrayItem]['subSections'][] = $current;
        continue;
    }

    // We're moving to the next parent item.
    $current['subSections'] = [];
    $parsedMenuSections[] = $current;
    $currentArrayItem++;
}
// Override the Sections with the updated version.
$menu->sections = $parsedMenuSections;
$context['menu'] = $menu;

foreach ($context['availableLocations'] as &$currentLocation) {
    if ($currentLocation->ID == $location->ID) {
        $currentLocation->active = 'selected';
    }
}

// Render!
$templates = array(
    'views/pages/page-eat.twig',
    'views/pages/page.twig',
);
Timber::render( $templates, $context );
