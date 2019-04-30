<?php

/**
 * Triple Seat + Gravityforms integration
 *
 * Refer to: https://tripleseat.zendesk.com/hc/en-us/articles/219006788-Using-the-API-Lead-Form-with-Gravity-Forms-in-Wordpress
 */

class CoralChildThemeTripleSeat
{
  private $apiKey = null;
  private $formID = null;

  public function __construct($key, $TSformID)
  {
    $this->apiKey = $key;
    $this->formID = $TSformID;

    add_action( "gform_after_submission_7", array($this, "submitPartyReservationRequest"), 10, 2 );
  }

  public function submitPartyReservationRequest( $entry, $form ) {

    // Triple Seat lead API URL
    $post_url = "https://api.tripleseat.com/v1/leads/create.js?lead_form_id={$this->formID}&public_key={$this->apiKey}";
  
    $body = array (
      "lead[first_name]" => rgar( $entry, "1.3" ), // required
      "lead[last_name]" => rgar( $entry, "1.6" ), // required
      "lead[location_id]" => $this->convertToTripleSeatLocation(rgar( $entry, "3")),
      "lead[email_address]" => rgar ($entry, "2"),
      "lead[phone_number]" => rgar( $entry, "13" ),
      // "lead[contact_preference]" => rgar( $entry, "41" ),
      "lead[event_description]" => rgar( $entry, "17" ),
      "lead[event_date]" => rgar( $entry, "14" ),
      // "lead[start_range]" => rgar( $entry, "16" ),
      // "lead[end_time]" => rgar( $entry, " ), // we don't currently have an end time field
      // "lead[guest_count]" => rgar( $entry, "19" ),
      "lead[additional_information]" => rgar( $entry, "16" )
    );
  
    GFCommon::log_debug( "gform_after_submission: body => " . print_r( $body, true ) );
    $request = new WP_Http();
    $response = $request->post( $post_url, array( "body" => $body ) );
    GFCommon::log_debug( "gform_after_submission: response => " . print_r( $response, true ) );
  
  }

  private function convertToTripleSeatLocation($value)
  {
    if (strpos(strtolower($value), 'augusta') !== false) {
      return 6443;
    }
    if (strpos(strtolower($value), 'buford') !== false) {
      return 3812;
    }
    if (strpos(strtolower($value), 'columbus') !== false) {
      return 4651;
    }
    if (strpos(strtolower($value), 'cumming') !== false) {
      return 2827;
    }
    if (strpos(strtolower($value), 'dacula') !== false) {
      return 2831;
    }
    if (strpos(strtolower($value), 'dallas') !== false) {
      return 2830;
    }
    if (strpos(strtolower($value), 'huntsville') !== false) {
      return 6209;
    }
    if (strpos(strtolower($value), 'loganville') !== false) {
      return 3813;
    }
    if (strpos(strtolower($value), 'sandy springs') !== false) {
      return 2832;
    }
    if (strpos(strtolower($value), 'stone mountain') !== false) {
      return 2829;
    }
    if (strpos(strtolower($value), 'woodstock') !== false) {
      return 3734;
    }

    // Default to Augusta
    return 6443;
  }
}

new CoralChildThemeTripleSeat("7e27960adce801fbe75f7f3ce376d2e10317dab1", "2576");
