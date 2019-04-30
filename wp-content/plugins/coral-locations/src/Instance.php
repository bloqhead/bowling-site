<?php

namespace Coral\Locations;

use Coral\Locations\Elements\CPT\LocationsCPT as CPT;
// @todo Set up Admin Options page so Page for results can be overridden
// @todo show a notice that we require cookies?

class Instance
{
    const PLUGIN_PREFIX = "coral_locations";
    protected static $_instance = null;
    protected $locationCPT;
    protected $finder;
    protected $selectedLocationID;
    private $location;
    private $selectionMethod;


    /**
     * SETTINGS
     */

    public static function getPageOptionKey() {
        return self::PLUGIN_PREFIX . "_page";
    }
    
    public static function getSelectedLocationKey() {
        return self::PLUGIN_PREFIX . "_location";
    }

    public static function getSelectionMethodKey() {
        return self::PLUGIN_PREFIX . "_method";
    }

    public static function getPageID()
    {
        return get_option(self::getPageOptionKey());
    }

    protected static function getSelectedLocationFromCookie() {
        if (!isset($_COOKIE[self::getSelectedLocationKey()])) {
            return null;
        }

        return $_COOKIE[self::getSelectedLocationKey()];
    }

    protected static function getSelectionMethodFromCookie() {
        if (!isset($_COOKIE[self::getSelectionMethodKey()])) {
            return null;
        }

        return $_COOKIE[self::getSelectionMethodKey()];
    }


    /**
     * CONSTRUCTORS
     */

    public function __construct()
    {
        // Set up necessary hooks to get going.
        $this->locationCPT = Elements\CPT\LocationsCPT::init();


        if (!is_admin()) {
            $this->finder = Elements\Finder::init(self::getPageID());
            Elements\Shortcodes::init();
        
            add_action("plugins_loaded", array($this, "manageSelectedLocation"));
        }

        if (is_admin()) {
            Elements\Admin::init($this);
            $this->locationCPT->registerAdminHandlers();
        }
    }

    public static function getInstance()
    {
        if ( self::$_instance == null ) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    public function getRedirectURL()
    {
        return $this->finder->setRedirectURL();
    }


    /**
     * GET PROPERTIES
     */

    public function getLocation()
    {
        return $this->location;
    }

    public function getSelectionMethod()
    {
        return $this->selectionMethod;
    }


    /**
     * CONDITIONALS
     */

    public static function hasValidPageID()
    {
        $pageID = self::getPageID();
        if (!$pageID) {
            return false;
        }

        $page = get_post($pageID);
        if (!$page || $page->post_status != 'publish') {
            return false;
        }

        return true;
    }

    public function wasLocationUserSelected()
    {
        return ($this->selectionMethod == 'user');
    }

    /**
     * HOOKS
     */

    public function manageSelectedLocation()
    {
        $this->selectedLocationID = self::getSelectedLocationFromCookie();
        $this->selectionMethod = self::getSelectionMethodFromCookie();
        if (isset($_GET["cl-location"]) && $this->locationCPT->findByID($_GET["cl-location"])) {
            $this->setLocation($_GET["cl-location"]);
            if (isset($_GET['redirect'])) {
                wp_redirect($_GET['redirect']);
                exit;
            }
        } elseif (!$this->selectedLocationID || !$this->locationCPT->findByID($this->selectedLocationID)) {
            $this->findAndSetLocation();
        }

        $this->assignSelectedLocation();
        $this->assignSelectionMethod();
    }

    public static function __activate()
    {
        $selectedPage = self::getPageID();
        if (!$selectedPage || !get_post($selectedPage)) {
            $args = array(
                "post_title" => "Location Selector",
                "post_type" => "page",
                "post_status" => "publish"
            );
            $postID = wp_insert_post($args);
            if (!is_wp_error($postID) ){
                update_option(self::getPageOptionKey(), $postID);
            } else {
                throw new \Exception($postID->get_error_message());
            }
        }
    }

    public static function __deactivate()
    {
        // Do nothing, currently.
    }


    /**
     * MANAGEMENT
     */

    protected function assignSelectedLocation($ID = null)
    {
        $ID = ($ID ? $ID : $this->selectedLocationID);
        $this->location = Models\Location::fromID($ID);
    }

    protected function assignSelectionMethod($method = null)
    {
        $method = ($method ? $method : $this->selectionMethod);
        $this->selectionMethod = $method;
    }

    protected function getClientIP()
    {
        if (WP_DEBUG) {
            return '97.76.99.30';
        }
    
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            return $_SERVER["HTTP_CLIENT_IP"];
        } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }

        return $_SERVER["REMOTE_ADDR"];
    }

    protected function setLocation($locationID, $selectionMethod = "user")
    {
        setcookie(self::getSelectedLocationKey(), $locationID, time()-3600, "/");
        setcookie(self::getSelectedLocationKey(), $locationID, 0, "/");
        $this->selectedLocationID = $locationID;

        $this->setSelectionMethod($selectionMethod);
    }

    public function setSelectionMethod($selectionMethod = "user")
    {
        setcookie(self::getSelectionMethodKey(), $selectionMethod, time()-3600, "/");
        setcookie(self::getSelectionMethodKey(), $selectionMethod, 0, "/");
        $this->selectionMethod = $selectionMethod;

        $this->assignSelectionMethod($selectionMethod);
    }

    protected function findAndSetLocation()
    {
        // make a guess.
        // get IP address of user.
        $ip = $this->getClientIP();
        // find geocode
        $geocoder = new Services\Geocode();
        $geocode = $geocoder->findByIP($ip);
        if (!$geocode) return $this->setLocation($this->getRandomLocation(), "auto");

        // get first result of closest locations.
        $match = $this->locationCPT->findByGeocode($geocode, 1);
        if (!$match) $this->setLocation($this->getRandomLocation(), "auto");

        $this->setLocation($match->ID, "auto");
    }

    protected function getRandomLocation()
    {
        $args = array(
            "post_type" => CPT::SLUG,
            "posts_per_page" => 1,
            "orderby" => "RAND",
        );
        
        $locations = get_posts($args);

        if (!is_array($locations) || !isset($locations[0])) {
            throw new \Exception("At least one post for '{$args["post_type"]}' must be set. Please set a sample, or provide details");
        }

        return $locations[0]->ID;
    }
}
