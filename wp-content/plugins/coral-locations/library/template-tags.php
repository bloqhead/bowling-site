<?php

if (!function_exists('coralLocation_pageLink')) :
function coralLocation_pageLink()
{
	$coralLocationHandler = coralLocations();

	return get_permalink($coralLocationHandler->getPageID());
}
endif;

if (!function_exists('coralLocationsResultsContent')) :
function coralLocationsResultsContent ()
{
	global $coralLocationsResultsOutput;

	return $coralLocationsResultsOutput;
}
endif;

if (!function_exists('coralLocation_selectionMethod')) :
function coralLocation_selectionMethod()
{
	$coralLocationHandler = coralLocations();
	return $coralLocationHandler->getSelectionMethod();
}
endif;

if (!function_exists('coralLocation_selectedLocationLink')) :
function coralLocation_selectedLocationLink()
{
	$currentLocation = coralSelectedLocation();

	if ($currentLocation) {
		return $currentLocation->link;
	}
}
endif;

if (!function_exists('coralLocation_selectedLocation')) :
function coralLocation_selectedLocation()
{
	$coralLocationHandler = coralLocations();
	return $coralLocationHandler->getLocation();
}
endif;

if (!function_exists('coralLocation_allLocations')) :
function coralLocation_allLocations()
{
	// @todo fine tune this and have it pull from the dynamic slug, hook for overriding, etc.
	return get_posts(array(
        'posts_per_page' => -1,
        'post_type' => 'locations',
        'orderby' => 'post_title',
        'order' => 'ASC',
    ));
}
endif;