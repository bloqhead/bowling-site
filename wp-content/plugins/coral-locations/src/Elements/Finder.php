<?php

namespace Coral\Locations\Elements;

use Coral\Locations\Services\Geocode;
use Coral\Locations\Elements\CPT\LocationsCPT as Locations;

class Finder
{
    public static function init($pageID)
    {
        return new self($pageID);
    }

    public function __construct($pageID)
    {
        $this->pageID = $pageID;

        // Set up hooks.
        if (apply_filters('coralLocations_Finder_AutoInclude', false)) {
            add_filter('the_content', array($this, 'showFinder'));
        }
        add_shortcode('display_locations_finder', array($this, 'showFinder'));
    }

    public function setRedirectURL()
    {
        $currentPage = trailingslashit(get_permalink($this->pageID));
        $redirectURL = (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : site_url());

        if (isset($_GET['redirect'])) {
            $redirectURL = $_GET['redirect'];
        }

        if (trailingslashit($redirectURL) == $currentPage) {
            $redirectURL = site_url();
        }
        
        $redirectURL = strtok($redirectURL, '?');
        
        $this->redirectURL = $redirectURL;
        return $redirectURL;
    }

    public function showFinder($content = '') {
        if (!is_page($this->pageID)) return $content;
        
        global $coralLocationsResultsOutput;

        if (apply_filters( 'coralLocations__allow_search', true )) {
            $output = $this->showSearchForm();
        } else {
            $_GET['clq'] = 'show-all';
            $output = $this->showLocations();
        }

        $content = apply_filters('coralLocations__content', $content);
        $response = $content . $output;
        if (apply_filters('coralLocations__show_form_top', false)) {
            $response = $output . $content;
        }

        $coralLocationsResultsOutput = $response;
        return $response;
    }

    public function getResults($response = [])
    {
        if (!$this->currentQuery) return $response;

        $geocoder = new Geocode();
        $locationsHandler = Locations::init();
        
        $geocode = $geocoder->findByString($this->currentQuery);
        if (!$geocode) return $response;

        return $locationsHandler->findByGeocode($geocode);
    }

    private function showSearchForm()
    {
        global $coralLocationsResults;
        global $coralLocationsRedirectURL;

        $this->currentQuery = (isset($_GET['clq']) ? $_GET['clq'] : null);
        $this->setRedirectURL();
        $coralLocationsRedirectURL = $this->redirectURL;
        $coralLocationsResults = $this->getResults();

        ob_start();
            $placeholder = apply_filters('coralLocations__placeholder', 'Enter your location');
            $button = apply_filters('coralLocations__button', 'Find');
            echo '<form class="form form-locations" id="coral-locations-form" method="get" action="'.get_permalink().'">';
                echo '<div>
                    <input name="clq" placeholder="'.$placeholder.'" value="'.$this->currentQuery.'" /> <button>'.$button.'</button> or <a href="'.$this->redirectURL.'">Cancel</a>
                    <input name="page_id" type="hidden" value="'.$this->pageID.'" />
                    <input name="redirect" type="hidden" value="'.$this->redirectURL.'" />
                </div>';
            echo '</form>';
            
            require_once(Templates::find('coral-locations-results'));

        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }

    private function showLocations()
    {
        global $coralLocationsResults;

        $locationsHandler = new Locations();
        $coralLocationsResults = $locationsHandler->getAll();

        ob_start();
            require_once(Templates::find('coral-locations-results'));
    
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }
}