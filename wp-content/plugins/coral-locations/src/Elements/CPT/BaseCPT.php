<?php

namespace Coral\Locations\Elements\CPT;

class BaseCPT
{
    const SLUG = "example";
    protected $icon = "dashicons-admin-page";
    protected $label_singular = "Example";
    protected $label_plural = "Examples";
    protected $supports = [];

    public function __construct()
    {
        add_action("init", array($this, "registerCPT"));
    }

    public function registerCPT()
    {
        $settings = apply_filters("coralLocations__cpt_settings", array(
            "labels" => array(
                "name"               => __($this->label_plural),
                "singular_name"      => __($this->label_singular),
                "menu_name"          => __($this->label_plural),
                "name_admin_bar"     => __($this->label_singular),
                "add_new"            => __("Add New"),
                "add_new_item"       => __("Add New {$this->label_singular}"),
                "new_item"           => __("New {$this->label_singular}"),
                "edit_item"          => __("Edit {$this->label_singular}"),
                "view_item"          => __("View {$this->label_singular}"),
                "all_items"          => __("All {$this->label_plural}"),
                "search_items"       => __("Search {$this->label_plural}"),
                "parent_item_colon"  => __("Parent {$this->label_plural}:"),
                "not_found"          => __("No {$this->label_plural} found."),
                "not_found_in_trash" => __("No {$this->label_plural} found in Trash.")
            ),
            "description"        => __(""),
            "public"             => true,
            "publicly_queryable" => true,
            "show_ui"            => true,
            "show_in_menu"       => true,
            "query_var"          => true,
            "rewrite"            => true,
            "capability_type"    => "page",
            "has_archive"        => true,
            "hierarchical"       => true,
            "menu_position"      => null,
            "menu_icon"          => $this->icon,
            "supports"           => $this->supports,
        ));
        $settings = apply_filters("coralLocations__cpt_".$this::SLUG."_settings", $settings);

        register_post_type($this::SLUG, $settings);
        do_action("coralLocations__cpt_after", $this::SLUG);
    }
}