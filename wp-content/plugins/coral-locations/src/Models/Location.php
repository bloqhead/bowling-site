<?php

namespace Coral\Locations\Models;

use Coral\Locations\Elements\CPT\LocationsCPT;

class Location
{
    public $ID;
    public $name;
    public $object;

    public function __construct($post)
    {
        $this->object = $post;
        $this->ID = $post->ID;
        $this->name = $this->applyFilter($post->post_title, 'the_title');
    }

    public function getTimberObject()
    {
        if (!class_exists('\TimberPost')) return null;

        $object = new \TimberPost($this->object);

        return $object;
    }

    public function __get($field)
    {
        if (isset($this->{$field})) {
            $value = $this->{$field};
        } else if (isset($this->object->{$field})) {
            $value = $this->object->{$field};
        } else if (isset($this->object->post_{$field})) {
            $value = $this->object->post_{$field};
        } else if ($field == 'link') {
            $value = $this->getPermalink();
        } else {
            $value = $this->getMeta($field);
        }

        return $this->applyFilter($value, "coralLocations__field_{$field}");
    }

    /**
     * Enhanced Collection
     */

    public function applyFilter($field, $filter)
    {
        $field = apply_filters($filter, $field, $this->object);

        return $field;
    }

    public function getPermalink()
    {
        $id = $this->ID;
        if (!$id) return null;

        return get_permalink($this->ID);
    }

    public function getMeta($field, $single = true)
    {
        $id = $this->ID;
        if (!$id) return null;

        // Redundancies, if no ACF for this install
        if (function_exists('get_field')) {
            return get_field($field, $id);
        }

        return get_post_meta($id, $field, $single);
    }

    /**
     * Loader Classes
     */
    public static function fromWPPost($post)
    {
        if (!$post) {
            return;
        }
        
        if ($post->post_type != LocationsCPT::SLUG) {
            throw new \Exception("Invalid Post Object (Must be of type '" . LocationsCPT::SLUG . "')");
        }

        return new Location($post);
    }

    public static function fromID($locationID)
    {
        $post = get_post($locationID);
        
        if ($post) {
            return self::fromWPPost($post);
        }

        //throw new \Exception("Invalid Post ID");
    }

    public static function fromSlug($slug)
    {
        $args = array(
            'name'              => $slug,
            'post_type'         => LocationsCPT::SLUG,
            'posts_per_page'    => 1
        );
        $matches = get_posts($args);
        
        if (!$matches) {
            throw new \Exception("Invalid Post Slug");
        }

        return self::fromID($matches[0]->ID);

    }
}