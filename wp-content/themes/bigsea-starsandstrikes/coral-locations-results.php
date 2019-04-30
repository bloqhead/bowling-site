<?php 

global $coralLocationsResults;

$context = Timber::get_context();
$context['redirect'] = coralLocations()->getRedirectURL();
$context['coralQuerySearch'] = (isset($_GET['clq']) ? true : false );
if ($coralLocationsResults && count($coralLocationsResults) > 0) {
    $context['locationMatches'] = Timber::get_posts($coralLocationsResults);
}
$templates = array( 'views/partials/locations-results-list.twig' );
$context['sidebar'] = Timber::get_sidebar( 'sidebar.php' );

Timber::render( $templates, $context );