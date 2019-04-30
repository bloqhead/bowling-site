(function() {
    // ScrollTrigger

  // Adds a class to the body so that you can
  // trigger things on scroll.

  // Example: `html.scrolled #navigation`

  var ScrollTrigger;

  ScrollTrigger = class ScrollTrigger {
    constructor() {
      this.scroll_change = this.scroll_change.bind(this);
      this.window = jQuery(window);
      this.document = jQuery("html");
      this.scrolled_class = "scrolled";
      this.distance = 50;
      this.scroll_change();
      if (typeof jQuery.throttle === 'function') {
        this.window.scroll(jQuery.throttle(100, this.scroll_change));
      } else {
        this.window.scroll(this.scroll_change);
      }
    }

    scroll_change(e) {
      this.window_top = this.window.scrollTop();
      if (this.window_top >= this.distance) {
        return this.document.addClass(this.scrolled_class);
      } else {
        return this.document.removeClass(this.scrolled_class);
      }
    }

  };

  new ScrollTrigger;

}).call(this);
