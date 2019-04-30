<?php

namespace Coral\Locations\Elements;

use Coral\Locations\Instance;

class Admin
{
    protected $db;
    
    public function __construct(Instance $coral)
    {
        global $wpdb;

        $this->coral = $coral;
        $this->db = $wpdb;

        add_action('init', array($this, 'setupHooks'));
    }

    public static function init($coral)
    {
        return new self($coral);
    }

    public function setupHooks()
    {
        $coral = $this->coral;
        register_setting( $coral::PLUGIN_PREFIX, $coral::getPageOptionKey() );

        add_action('admin_menu', array($this, 'menus'));
        add_action('admin_notices', array($this, 'notices'));
        add_filter('display_post_states', array($this, 'postStates'), 99, 2);
    }

    public function notices()
    {
        if (!$this->coral->hasValidPageID()) {
            echo '
                <div class="notice notice-error">
                    <p><strong>Coral Locations:</strong> Missing a valid page for selecting a location. Page must be selected and published.</p>
                </div>
            ';
        }

        if (!class_exists('\acf') || !class_exists('\acf_plugin_repeater')) {
            echo '
                <div class="notice notice-error">
                    <p><strong>Coral Locations:</strong> Advanced Custom Fields and ACF Repeater are required plugins.</p>
                </div>
            ';
        }
    }

    public function postStates($states, $post)
    {
        $coral = $this->coral;
        if ($coral::getPageID() == $post->ID) {
            $states[] = 'Coral Locations Page';
        }

        return $states;
    }

    public function menus()
    {
        add_options_page('Locations', 'Coral Locations', 'manage_options', 'coral-locations', array($this, 'settingsPage'));
    }

    public function settingsPage()
    {
        require_once(CORAL_LOCATIONS_PATH . 'templates/admin/settings.php');
    }
}