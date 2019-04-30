jQuery(window).load(function () {
  if (typeof lity == 'undefined') return;

  const lityModal = lity('#coral-location-modal', {
      'esc' : false
  });

  jQuery.ajax({
      url : window.coral_modal.url,
      method : 'POST',
      data : {
          action : 'coral_locations_modal'
      },
      complete : function(jqXHR, response) {
          // Do nothing, because it doesn't matter for this initial load.
      }
  });
  // jQuery('body').on('click', '.coral__confirm-location', function(e) {
  //     e.preventDefault();
      
  // });

  jQuery('body').on('click', '.coral__selector-close', function(e) {
      e.preventDefault();

      lityModal.close();
  });
});