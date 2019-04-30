<?php

namespace Coral\Locations\Models;

use Geocoder\Model\Coordinates;

class Geocode
{
    public $latitude;
    public $longitude;

    public static function fromGeocoderCoordinates(Coordinates $geocoderObject)
    {
        $geocode = new self();
        $geocode->latitude = $geocoderObject->getLatitude();
        $geocode->longitude = $geocoderObject->getLongitude();

        return $geocode;
    }

    public static function fromNavigator($data)
    {
        /*
          array(2) {
            ["coords"]=>
            array(7) {
                ["latitude"]=> string(10) "27.7701763"
                ["longitude"]=> string(11) "-82.6434805"
                ["altitude"]=> string(0) ""
                ["accuracy"]=> string(4) "7458"
                ["altitudeAccuracy"]=> string(0) ""
                ["heading"]=> string(0) ""
                ["speed"]=> string(0) ""
            }
            ["timestamp"]=> string(13) "1536933427689"
            }
        */

        $geocode = new self();
        $geocode->latitude = $data['coords']['latitude'];
        $geocode->longitude = $data['coords']['longitude'];

        return $geocode;
    }

    public static function fromCache($jsonObject)
    {
        if (!$jsonObject) {
            return null;
        }

        $geocode = new self();
        $geocode->latitude = $jsonObject->latitude;
        $geocode->longitude = $jsonObject->longitude;

        return $geocode;
    }
}