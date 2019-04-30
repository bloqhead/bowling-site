<?php

namespace Coral\Locations\Elements;

use Coral\Locations\Instance;
use Coral\Locations\Models\Geocode as GeocodeModel;
use Coral\Locations\Elements\CPT\LocationsCPT as Locations;

class AjaxServices
{
    protected $coral;
    protected $db;
    
    public function __construct(Instance $coral)
    {
        $this->coral = $coral;

        add_action('init', array($this, 'setupHooks'));
        add_action('wp_ajax_coral_locations_geolocation_list', array($this, 'getList'));
        add_action('wp_ajax_nopriv_coral_locations_geolocation_list', array($this, 'getList'));
    }

    public static function init($coral)
    {
        return new self($coral);
    }

    protected function endAJAXResponse($data)
    {
        echo json_encode($data);
        wp_die();
    }

    public function getList()
    {
        $response = array(
            'status' => 'error',
            'message' => '',
            'data' => null,
        );

        // Confirm we have GeoLocation data provided.
        if (!$_POST['position']) {
            $response['message'] = 'Missing geocode coordinates';
            return $this->endAJAXResponse($response);
        }

        // Get the list of locations sorted by GeoLocation
        $geocode = GeocodeModel::fromNavigator($_POST['position']);
        $locationsHandler = Locations::init();
        
        $response['status'] = 'success';
        $response['data'] = apply_filters('coralLocations__ajax_geolocations_response_data', $locationsHandler->findByGeocode($geocode, 1000));

        // Return the data (with apply_filters)
        $response = apply_filters('coralLocations__ajax_geolocations_response', $response);
        return $this->endAJAXResponse($response);
    }

    public function setupHooks()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueueScriptsAndStyles'));
    }

    public function enqueueScriptsAndStyles()
    {
        $requirements = array('jquery');
        wp_enqueue_script( 'coral-locations-geolocations', CORAL_LOCATIONS_URL . 'assets/js/geolocations.js', $requirements, true );
        wp_localize_script( 'coral-locations-geolocations', 'coral_geolocations', array(
            'url' => admin_url('admin-ajax.php'),
        ));
    }
}
