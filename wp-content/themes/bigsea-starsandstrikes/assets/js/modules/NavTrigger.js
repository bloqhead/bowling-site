(function() {
    // Mobile Nav Trigger

  var NavTrigger;

  NavTrigger = class NavTrigger {
    constructor() {
      this.hamburger = jQuery('.hamburger');
      this.navContainer = jQuery('.top-bar');
      this.activeClass = 'is-active';
      this.parentClass = 'is-locked';
      this.trigger(this.hamburger, this.activeClass, this.parentClass, 'body', this.navContainer);
    }

    trigger(el, active, locked, parent, nav) {
      if (el.length === 0) {
        return;
      }
      return el.on('click', function(e) {
        jQuery(this).toggleClass(active);
        jQuery(parent).toggleClass(locked);
        return nav.toggleClass(active);
      });
    }

  };

  new NavTrigger;

}).call(this);
