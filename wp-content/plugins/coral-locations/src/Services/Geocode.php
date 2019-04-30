<?php

namespace Coral\Locations\Services;

use Geocoder\Query\GeocodeQuery;
use Coral\Locations\Services\Cache;
use Coral\Locations\Models\Geocode as GeocodeModel;

class Geocode
{
    protected $cache;
    protected $geocoder;

    public function __construct()
    {
        $adapter  = new \Http\Adapter\Guzzle6\Client();
        $this->geocoder = new \Geocoder\ProviderAggregator();

        $provider_google = new \Geocoder\Provider\GoogleMaps\GoogleMaps($adapter, "United States", "AIzaSyAf6SIcqjXFX2dG8M6He3tJIJIwehz-gfw");
        $this->geocoder->registerProvider($provider_google);

        // $provider_yandex = new \Geocoder\Provider\Yandex\Yandex($adapter);
        // $this->geocoder->registerProvider($provider_yandex);

        $provider_freegeoip = new \Geocoder\Provider\FreeGeoIp\FreeGeoIp($adapter);
        $this->geocoder->registerProvider($provider_freegeoip);

        $this->cache = new Cache();
    }

    public function findByAddress($city, $state, $street = "", $zip = "")
    {
        $addressString = $this->generateAddressString($street, $city, $state, $zip);

        $this->geocoder->using('google_maps');
        return $this->find($addressString);
    }

    public function findByString($string)
    {
        $this->geocoder->using('google_maps');
        return $this->find($string);
    }

    public function findByIP($ip)
    {
        $this->geocoder->using('free_geo_ip');
        return $this->find($ip);
    }

    private function find($string)
    {
        try {
            if ($cached = $this->getCache($string)) {
                return GeocodeModel::fromCache($cached);
            }

            $query = GeocodeQuery::create($string);
            $results = $this->geocoder
                            ->geocodeQuery($query);
            if (count($results->all()) <= 0) {
                throw new \Exception("No Results Found");
            }

            $geocode = $this->getGeocodeFromResults($results);

            $response = GeocodeModel::fromGeocoderCoordinates($geocode);
            $this->setCache($string, $response);

            return $response;
        } catch (\Exception $e) {
            return null;
        }

        return null;
    }

    private function getGeocodeFromResults($results)
    {
        $geocode = $results->first()->getCoordinates();

        $filters = $this->getResultFilters();
        if ($filters) {
            foreach ($results->all() as $current) {
                foreach ($current->getAdminlevels() as $adminLevel) {
                    if (in_array($adminLevel->getCode(), $filters)) {
                        $geocode = $current->getCoordinates();
                        break 2;
                    }
                }
            }
        }

        if (!$geocode) {
            throw new \Exception("Coordinates not found. If testing on a local system, turn on WP_DEBUG");
        }

        return $geocode;
    }

    private function getResultFilters()
    {
        $filters = apply_filters('coralLocations__filter_adminlevels', false);
        if ($filters && !is_array($filters)) {
            $filters = array($filters);
        }

        return $filters;
    }

    private function setCache($key, GeocodeModel $value)
    {
        $key = "geocode_" . $this->generateKey($key);

        return $this->cache->set($key, json_encode($value));
    }
    private function getCache($key)
    {
        $key = "geocode_" . $this->generateKey($key);
        if ($match = $this->cache->get($key)) {
            return json_decode($match);
        }

        return false;
    }

    private function generateAddressString($street, $city, $state, $zip)
    {
        if ($street != "") {
            $street .= ",";
        }
        
        return trim("{$street} {$city}, {$state} {$zip}");
    }

    private function generateKey($key)
    {
        $key = strtolower($key);
        $key = preg_replace("/[^0-9a-z]/i", "", $key);

        return md5($key);
    }
}