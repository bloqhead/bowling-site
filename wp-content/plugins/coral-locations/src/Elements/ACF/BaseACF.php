<?php

namespace Coral\Locations\Elements\ACF;

class BaseACF
{
    protected $fields = [];

    public function get($key, $postID = null)
    {
        $postID = ($postID ? $postID : get_the_ID());
        $acfKey = $this->getACFkey($key);
        if (function_exists("get_field") && $acfKey) {
            return get_field($acfKey, $postID);
        }

        return get_post_meta($postID, $key, true);
    }

    public function set($key, $value, $postID = null)
    {
        $postID = ($postID ? $postID : get_the_ID());
        $acfKey = $this->getACFkey($key);
        
        if (function_exists("update_field") && $acfKey) {
            return update_field($acfKey, $value, $postID);
        }

        return update_post_meta($postID, $key, $value);
    }

    protected function getACFkey($key, $fields = null)
    {
        if (!$fields) {
            $fields = $this->fields;
        }

        foreach ($fields as $field) {
            // Allows for recursive, but don't currently do this.
            // if ($field['type'] == 'repeater') {
            //     return $this->getACFkey($key, $field['sub_fields']);
            // }

            if ($field['name'] == $key) {
                return $field['key'];
            }
        }

        return null;
    }
}
