<?php

/*
    Plugin Name: Coral Locations
	Plugin URI: http://bigsea.co/
	Description: Installs a Locations CPT and provides the ability for users to select which location they'd prefer in their settings while visiting the site.
	Version: 0.9.3
	Author: Big Sea
	Author URI: http://bigsea.co
*/

define('CORAL_LOCATIONS_PATH', __DIR__ . "/");
define('CORAL_LOCATIONS_URL', plugin_dir_url( __FILE__ ));

function coralLocations()
{
	require_once(CORAL_LOCATIONS_PATH . '/vendor/autoload.php');
	return Coral\Locations\Instance::getInstance();
}
$coralLocations = coralLocations();

if (apply_filters('coralLocations__include_modal', true)) {
	Coral\Locations\Elements\Modal::init($coralLocations);
}

if (apply_filters('coralLocations__include_ajax_services', true)) {
	Coral\Locations\Elements\AjaxServices::init($coralLocations);
}

add_action( 'after_setup_theme', 'coralIncludeAfterTheme' );
function coralIncludeAfterTheme()
{
	require_once(CORAL_LOCATIONS_PATH . 'library/template-tags.php');
	require_once(CORAL_LOCATIONS_PATH . 'library/gravity-forms.php');
}

register_activation_hook( __FILE__, 'coralLocations_activate' );
function coralLocations_activate()
{
	$self = coralLocations();
	$self->__activate();
}

register_deactivation_hook( __FILE__, 'coralLocations_deactivate' );
function coralLocations_deactivate()
{
	$self = coralLocations();
	$self->__deactivate();
}