<?php

namespace Coral\Locations\Elements\ACF;

class LocationsACF extends BaseACF
{
    protected $fields = array (
        array (
            "key" => 'field_5a54f8ee44d99',
            "label" => "Address",
            "name" => "address",
            "type" => "repeater",
            "required" => 1,
            "sub_fields" => array (
                array (
                    "key" => "field_5a54f90844d9a",
                    "label" => "Street",
                    "name" => "street",
                    "type" => "text",
                    "required" => 1,
                    "column_width" => "",
                    "default_value" => "",
                    "placeholder" => "",
                    "prepend" => "",
                    "append" => "",
                    "formatting" => "none",
                    "maxlength" => "",
                ),
                array (
                    "key" => "field_5a54f91844d9b",
                    "label" => "Street 2",
                    "name" => "suite",
                    "type" => "text",
                    "column_width" => "",
                    "default_value" => "",
                    "placeholder" => "",
                    "prepend" => "",
                    "append" => "",
                    "formatting" => "none",
                    "maxlength" => "",
                ),
                array (
                    "key" => "field_5a54f98144d9c",
                    "label" => "City",
                    "name" => "city",
                    "type" => "text",
                    "required" => 1,
                    "column_width" => "",
                    "default_value" => "",
                    "placeholder" => "",
                    "prepend" => "",
                    "append" => "",
                    "formatting" => "none",
                    "maxlength" => "",
                ),
                array (
                    "key" => "field_5a54f98e44d9d",
                    "label" => "State/Province",
                    "name" => "state",
                    "type" => "text",
                    "required" => 1,
                    "column_width" => "",
                    "default_value" => "",
                    "placeholder" => "",
                    "prepend" => "",
                    "append" => "",
                    "formatting" => "none",
                    "maxlength" => "",
                ),
                array (
                    "key" => "field_5a54f99a44d9e",
                    "label" => "Zip/Postal Code",
                    "name" => "zip_code",
                    "type" => "text",
                    "required" => 1,
                    "column_width" => "",
                    "default_value" => "",
                    "placeholder" => "",
                    "prepend" => "",
                    "append" => "",
                    "formatting" => "none",
                    "maxlength" => "",
                ),
            ),
            "row_min" => 1,
            "row_limit" => 1,
            "layout" => "table",
            "button_label" => "Add Address",
        ),
        // array (
        //     "key" => "field_5a54f99a44d9f",
        //     "label" => "Latitude",
        //     "name" => "latitude",
        //     "type" => "text",
        //     "required" => 1,
        //     "column_width" => "",
        //     "default_value" => "",
        //     "placeholder" => "",
        //     "prepend" => "",
        //     "append" => "",
        //     "formatting" => "none",
        //     "maxlength" => "",
        // ),
        // array (
        //     "key" => "field_5a54f99a44dA0",
        //     "label" => "Longitude",
        //     "name" => "longitude",
        //     "type" => "text",
        //     "required" => 1,
        //     "column_width" => "",
        //     "default_value" => "",
        //     "placeholder" => "",
        //     "prepend" => "",
        //     "append" => "",
        //     "formatting" => "none",
        //     "maxlength" => "",
        // ),
    );

    public function __construct()
    {
        //$this->assignACFfields();
    }

    public function assignACFfields()
    {
        if(function_exists("register_field_group")) :
            register_field_group(array (
                "id" => "acf_locations",
                "title" => "Locations",
                "fields" => $this->fields,
                "location" => array (
                    array (
                        array (
                            "param" => "post_type",
                            "operator" => "==",
                            "value" => "locations",
                            "order_no" => 0,
                            "group_no" => 0,
                        ),
                    ),
                ),
                "options" => array (
                    "position" => "normal",
                    "layout" => "no_box",
                    "hide_on_screen" => array (
                    ),
                ),
                "menu_order" => 0,
            ));
        endif;
    }
}