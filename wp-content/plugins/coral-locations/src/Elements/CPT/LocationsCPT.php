<?php

namespace Coral\Locations\Elements\CPT;

use Coral\Locations\Elements\ACF;
use Coral\Locations\Services\Geocode;
use Coral\Locations\Models\Geocode as GeocodeModel;

class LocationsCPT extends BaseCPT
{
    const SLUG = "locations";
    private static $_instance = null;
    protected $icon = "dashicons-location";
    protected $label_singular = "Location";
    protected $label_plural = "Locations";
    protected $fields;
    protected $supports = [
        "title",
        "thumbnail",
        "page-attributes",
        "editor"
    ];

    public static function init()
    {
        if ( self::$_instance == null ) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    public function __construct()
    {
       parent::__construct();

       $this->fields = new ACF\LocationsACF();
       $this->fields->assignACFfields();
    }

    public function registerAdminHandlers()
    {

       add_action('save_post', array($this, 'savePost'));
    }

    public function savePost($postID)
    {
        if (get_post_type($postID) != $this::SLUG) return;

        $addressTable = $this->fields->get('address', $postID);
        if (!is_array($addressTable) || count($addressTable) <= 0) return;
        if ($addressTable[0]['street'] == '') return;

        // Currently only works with the first row.
        $address = $addressTable[0];
        $geocoder = new Geocode();
        $geocode = $geocoder->findByAddress($address['city'], $address['state'], $address['street'], $address['zip_code']);
        if ($geocode) {
            $this->fields->set('latitude', $geocode->latitude);
            $this->fields->set('longitude', $geocode->longitude);
        }
    }

    public function findByID($postID)
    {
        $post = get_post($postID);
        if (
            !$post ||
            $post->post_status != 'publish' ||
            $post->post_type != $this::SLUG
        ) {
            return false;
        }

        return $post;
    }

    public function getAll($args = [])
    {
        $args = array_merge(array(
            'posts_per_page' => -1,
            'post_type' => $this::SLUG,
            'orderby' => 'title',
            'order' => 'ASC',
        ), $args);

        $query = new \WP_Query($args);
        
        if ($query->have_posts()) {
            return $query->posts;
        }

        return null;
    }

    public function findByGeocode(GeocodeModel $geocode, $limit = 5, $offset = 0)
    {
        global $wpdb;

        // @todo get this working inside of a WP_Query
        $query = "SELECT 
                p.ID, 
                pm1.meta_value as latitude,
                pm2.meta_value as longitude,
                ROUND(( 3959 * acos( cos( radians({$geocode->latitude}) ) 
                        * cos( radians(pm1.meta_value) ) 
                        * cos( radians(pm2.meta_value) - radians($geocode->longitude)) + sin(radians({$geocode->latitude})) 
                        * sin( radians(pm1.meta_value)))
                    ), 3) AS distance 
            FROM wp_posts p
                LEFT JOIN wp_postmeta pm1 ON p.ID = pm1.post_id 
                LEFT JOIN wp_postmeta pm2 ON p.ID = pm2.post_id 
            WHERE 
                (p.post_type = 'locations' AND p.post_status = 'publish' AND
                pm1.meta_key = 'latitude' AND
                pm2.meta_key = 'longitude')
            ORDER BY distance ASC
            LIMIT {$offset}, {$limit}
        ";

        $results = $wpdb->get_results($query);
        $response = [];
        if ($results && count($results) > 0) {
            foreach ($results as $location) {
                $locationDetails = get_post($location->ID);
                if (!$locationDetails) continue;

                $locationDetails->latitude = $location->latitude;
                $locationDetails->longitude = $location->longitude;
                $locationDetails->distance = $location->distance;

                $response[] = $locationDetails;
            }
        }

        if ($limit == 1) {
            if (!count($response) > 0) {
                return null;
            }
            return $response[0];
        }

        return $response;
    }
}