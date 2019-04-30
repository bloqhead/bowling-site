<?php

namespace Coral\Locations\Elements;

use Coral\Locations\Instance;

class Modal
{
    protected $coral;
    protected $db;
    
    public function __construct(Instance $coral)
    {
        $this->coral = $coral;

        add_action('init', array($this, 'setupHooks'));
        add_action('wp_ajax_coral_locations_modal', array($this, 'confirmCheckin'));
        add_action('wp_ajax_nopriv_coral_locations_modal', array($this, 'confirmCheckin'));
    }

    public static function init($coral)
    {
        return new self($coral);
    }

    public function confirmCheckin()
    {
        $this->coral->setSelectionMethod("modal");
        echo 'Success';
        wp_die();
    }

    public function setupHooks()
    {
        if ($this->coral->getSelectionMethod() == 'auto') {
            add_action('wp_enqueue_scripts', array($this, 'enqueueScriptsAndStyles'));
            add_action('wp_footer', array($this, 'includeModal'));
        }
    }

    public function includeModal()
    {
        require_once(Templates::find('coral-locations-modal'));
    }

    public function enqueueScriptsAndStyles()
    {
        $requirements = array('jquery');
        if (apply_filters('coral-locations-include-lity', true)) {
            wp_enqueue_script( 'lity', CORAL_LOCATIONS_URL . 'assets/js/vendor/lity.js', array('jquery'), true, '3.0.0' );
            $requirements[] = 'lity';
        }
        wp_enqueue_script( 'coral-locations-modal', CORAL_LOCATIONS_URL . 'assets/js/modal.js', $requirements, true );
        wp_localize_script( 'coral-locations-modal', 'coral_modal', array(
            'url' => admin_url('admin-ajax.php'),
        ));
    }
}
