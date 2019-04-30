/*
 * jQuery throttle / debounce - v1.1 - 3/7/2010
 * http://benalman.com/projects/jquery-throttle-debounce-plugin/
 *
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function(b,c){var $=b.jQuery||b.Cowboy||(b.Cowboy={}),a;$.throttle=a=function(e,f,j,i){var h,d=0;if(typeof f!=="boolean"){i=j;j=f;f=c}function g(){var o=this,m=+new Date()-d,n=arguments;function l(){d=+new Date();j.apply(o,n)}function k(){h=c}if(i&&!h){l()}h&&clearTimeout(h);if(i===c&&m>e){l()}else{if(f!==true){h=setTimeout(i?k:l,i===c?e-m:e)}}}if($.guid){g.guid=j.guid=j.guid||$.guid++}return g};$.debounce=function(d,e,f){return f===c?a(d,e,false):a(d,f,e!==false)}})(this);
;/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var container, button, menu, links, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'site-menu' ) ) {
		menu.className += ' site-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .site-menu.
		while ( -1 === self.className.indexOf( 'site-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
} )();
;/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var isWebkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
	    isOpera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
	    isIe     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

	if ( ( isWebkit || isOpera || isIe ) && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
})();
;(function() {
    // Add a class when JS is enabled

  // Removes the `no-js` class from the
  // `html` element when JS is enabled,
  // and adds a `yes-js` class.
  // This allows you to target things
  // only when JS is present.

  jQuery("html").removeClass("no-js").addClass("yes-js");

}).call(this);
;(function() {
    // ScrollToTop

  var ScrollToTop;

  ScrollToTop = class ScrollToTop {
    constructor() {
      this.scroll_check = this.scroll_check.bind(this);
      this.scroll_click = this.scroll_click.bind(this);
      this.window = jQuery(window);
      this.document = jQuery("body");
      this.btn = jQuery(".scroll-to-top");
      this.btn_hidden_class = "scroll-to-top--hidden";
      this.distance = 100;
      this.speed = 400;
      this.window.scroll(this.scroll_check);
      this.btn.on("click", this.scroll_click);
    }

    scroll_check(e) {
      if (jQuery(window).scrollTop() > this.distance) {
        this.btn.removeClass(this.btn_hidden_class);
      } else {
        this.btn.addClass(this.btn_hidden_class);
      }
    }

    scroll_click(e) {
      return this.document.animate({
        scrollTop: 0
      }, this.speed);
    }

  };

  new ScrollToTop;

}).call(this);
;(function() {
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
