<?php

if (!is_admin()) {
  add_action('coralLocations__allow_search', '__return_false');
}

add_filter('coralLocations__ajax_geolocations_response_data', 'strikes_organizeDropdownList');
function strikes_organizeDropdownList($data)
{
  foreach ($data as &$current) {
    $current = new \TimberPost($current);
  }
  $context = array(
    'locations' => $data
  );
  $templates = [ 'views/partials/affixed-locations-selector.twig' ];

  ob_start();

    \Timber::render($templates, $context);

  $contents = ob_get_contents();
  ob_end_clean();

  return $contents;
}

add_filter('coralLocations__filter_adminlevels', 'filterLocationsByState', 10, 1);
function filterLocationsByState($filters)
{
    // can return a string, or array.
    return array('GA', 'AL');
}