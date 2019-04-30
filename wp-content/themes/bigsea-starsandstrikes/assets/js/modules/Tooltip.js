(function() {
  (function($) {
    jQuery('.notice').on('click', function(e) {
      e.preventDefault();
      return jQuery(this).parent().parent().find('.hours__tooltip').fadeToggle();
    });
    return jQuery('.hours__tooltip-close').on('click', function(e) {
      e.preventDefault();
      return jQuery(this).parent().fadeOut();
    });
  })(jQuery);

}).call(this);
