<?php

namespace Coral\Locations\Services;

class Cache
{
    private $cachePath = "";

    public function __construct()
    {
        $this->cachePath = apply_filters("coralLocations__cachepath", CORAL_LOCATIONS_PATH . "data/");
    }

    private function getFile($key)
    {
        return "{$this->cachePath}{$key}.txt";
    }

    public function get($key)
    {
        $file = $this->getFile($key);
        if (!file_exists($file)) {
            return null;
        }
        
        return file_get_contents($file);
    }

    public function set($key, $value)
    {
        return file_put_contents($this->getFile($key), $value);
    }
}
