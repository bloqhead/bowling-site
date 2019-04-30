(function() {
    // Affixed Location Selector

  (function($) {
    var $body, contentBlock, expandTrigger, locationTooltip, mainClass, tooltipTrigger;
    mainClass = 'show-affixed-location-selector';
    contentBlock = $('.affixed-location-selector__content');
    expandTrigger = $('.affixed-location-selector__changer');
    $body = $('body');
    locationTooltip = $('.affixed-location-selector__tooltip');
    tooltipTrigger = $('.user-actions__mobile-selector, .user-actions__desktop-selector');
    // add a class once the page is loaded
    // $(window).on 'load', ->
    // 	$('html').addClass mainClass

    // adjust the top padding to accommodate for the bar as needed
    // $(window).on 'load resize', ->
    // 	i = $('.affixed-location-selector__initial').outerHeight() + 'px'
    // 	$('body').css 'padding-top': i

    // expand the location list on button click
    tooltipTrigger.on('click', function(e) {
      $(this).toggleClass('is-active');
      locationTooltip.toggleClass('is-expanded');
      if (!locationTooltip.hasClass('update-attempted')) {
        window.getLocationsByGeolocation();
        locationTooltip.addClass('update-attempted');
      }
      return e.preventDefault();
    });
    $body.on('coral_locations_geolocation_waiting', (e) => {
      return locationTooltip.addClass('is-updating');
    });
    $body.on('coral_locations_geolocation_complete', (e) => {
      return locationTooltip.removeClass('is-updating');
    });
    return $body.on('coral_locations_geolocation_data', (e, data) => {
      return locationTooltip.html(data);
    });
  })(jQuery);

}).call(this);
