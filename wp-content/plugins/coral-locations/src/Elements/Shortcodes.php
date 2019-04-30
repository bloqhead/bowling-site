<?php

namespace Coral\Locations\Elements;

class Shortcodes
{
    public static function init()
    {
        return new self();
    }

    public function __construct()
    {
        add_shortcode('coral-location', array($this, 'renderSelectedLocation'));
    }

    public function renderSelectedLocation()
    {
        $location = coralSelectedLocation();

        var_dump($location); exit;
    }
}