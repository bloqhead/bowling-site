<?php

if ( is_admin () ) :
    add_filter('gform_predefined_choices', 'gf_coralLocationsChoices', 10, 1);
else :
    //add_filter('gform_field_content', 'gf_coralLocationsSelection', 10, 5);
endif;

function gf_coralLocationsChoices ( $choices ) {
    $locations = coralLocation_allLocations();

    $list = array ();

    foreach ( $locations as $location ) :
        $list[] = addslashes($location->post_title . "|" . $location->post_name);
    endforeach;

    $choices['Coral Locations'] = $list;

    return $choices;
}

function gf_coralLocationsSelection ($field_content, $field, $value, $something, $form_id) {
    if ( $field->type != 'select' ) return $field_content;

    var_dump($field); exit;

} // function