(function() {
    // Open outbound links in a new window/tab automagically

  (function() {
    return jQuery('a:not(.ndpl-component__code-toggle):not(.ext-click-exclude)').filter(function(i, el) {
      var startOfUrl, target;
      startOfUrl = location.protocol + '//' + location.hostname;
      target = el.href.indexOf(startOfUrl) === 0;
      if (target === false) {
        return jQuery(this).on('click', function(e) {
          e.preventDefault();
          return window.open(jQuery(this).attr('href'), '_blank');
        });
      }
    });
  }).call(this);

}).call(this);
