(function() {
    // Mobile menu controls

  var MobileMenu;

  MobileMenu = class MobileMenu {
    constructor() {
      
      // Toggle the active class of the parent menu item

      this.ToggleActiveClass = this.ToggleActiveClass.bind(this);
      this.SubmenuIndicator = this.SubmenuIndicator.bind(this);
      
      // Append the parent link to the top of the submenu for mobile

      this.ParentLinkCreator = this.ParentLinkCreator.bind(this);
      
      // Clean up tasks for when an orientation change occurs
      // or a similar event

      this.Cleanup = this.Cleanup.bind(this);
      // @targetMenu     = jQuery '.top-bar > .inner > .menu'
      this.targetMenu = jQuery('.top-bar > .inner > .menu-container > .menu');
      this.icon = '<i class="far fa-angle-down no-transform mobile-menu-item-icon"></i>';
      this.activeClass = 'is-active';
      this.dropdownItem = this.targetMenu.find('li.has-dropdown');
      this.dropdownLink = this.dropdownItem.find('> a');
      // do nothing if there are no dropdowns present
      if (jQuery('li.has-dropdown').length === 0) {
        return;
      }
      jQuery(window).on('load', () => {
        if (window.innerWidth < 960) {
          return this.ParentLinkCreator();
        }
      });
      jQuery(window).on('load resize', () => {
        if ('ontouchstart' in document.documentElement) {
          this.ToggleActiveClass(this.dropdownLink, this.activeClass);
        }
        this.SubmenuIndicator(this.dropdownLink, this.icon);
        return this.Cleanup();
      });
    }

    ToggleActiveClass(dropdown, activeClass) {
      return dropdown.on('click', function(e) {
        jQuery(this).toggleClass(activeClass);
        return e.preventDefault();
      });
    }

    SubmenuIndicator(link, icon) {
      if (link.find("i.mobile-menu-item-icon").length === 0) {
        return this.dropdownLink.append(icon);
      }
    }

    ParentLinkCreator() {
      return jQuery('li.has-dropdown').each(function() {
        var href, link, subMenu, text;
        link = jQuery(this).find('> a');
        subMenu = jQuery(this).find('> a + .menu');
        href = link.attr('href');
        text = link.text();
        // only append the link if it's not a placeholder...
        if (href !== "#") {
          return subMenu.prepend(`<li class='menu-item'><a href='${href}'>${text}</a></li>`);
        }
      });
    }

    Cleanup() {
      var i;
      i = 0;
      if (i === 0 && window.innerWidth >= 960) {
        this.dropdownLink.find("i.mobile-menu-item-icon").remove();
        i = 1;
      }
      if (i === 1 && window.innerWidth < 960) {
        this.SubmenuIndicator(this.dropdownLink, this.icon);
        return i = 0;
      }
    }

  };

  new MobileMenu;

}).call(this);
