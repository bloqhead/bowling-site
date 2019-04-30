window.getLocationsByGeolocation = function() {
    const $body = jQuery('body');

    if (typeof localStorage != 'undefined' && localStorage.getItem('coral-geolocation-results')) {
        $body.trigger('coral_locations_geolocation_waiting');
        console.log('getting data');
        $body.trigger('coral_locations_geolocation_data', [localStorage.getItem('coral-geolocation-results')]);
        $body.trigger('coral_locations_geolocation_complete');
    }

    // Even though we had local storage results... let's still see if we have a different list to swap in.
    //     @TODO make this more subtle?
				
    if ("geolocation" in navigator) {
        $body.trigger('coral_locations_geolocation_waiting');
        $body.addClass('coral-locations-geolocation-processing');
        navigator.geolocation.getCurrentPosition(function(position) {
            if (typeof localStorage != 'undefined') {
                // storing the position. we might take advantage of comparing locations in the future.
                console.log('saving position');
                localStorage.setItem('coral-geolocation-position', position);
            }

            jQuery.ajax({
                url : window.coral_geolocations.url,
                method : 'POST',
                data : {
                    'action' : 'coral_locations_geolocation_list',
                    'position' : position
                },
                complete : function(jqXHR, status) {
                    // Do whatever we need to do to render.
                    var response = jQuery.parseJSON(jqXHR.responseText);

                    if (status == 'success' && response && response.status == 'success') {
                        $body.trigger('coral_locations_geolocation_data', [response.data]);
                        if (typeof localStorage != 'undefined') {
                            console.log('saving data');
                            localStorage.setItem('coral-geolocation-results', response.data);
                        }
                    }

                    $body.trigger('coral_locations_geolocation_complete');
                    $body.removeClass('coral-locations-geolocation-processing');
                }
            });
        });
    }
};

// Testing
// jQuery(window).load(function() {
//     window.getLocationsByGeolocation();
// });