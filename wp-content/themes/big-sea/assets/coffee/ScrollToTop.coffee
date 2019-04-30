#
# ScrollToTop
#

class ScrollToTop

	constructor: () ->
		@window = jQuery window
		@document = jQuery "body"
		@btn = jQuery ".scroll-to-top"
		@btn_hidden_class  = "scroll-to-top--hidden"
		@distance = 100
		@speed = 400

		@window.scroll @scroll_check

		@btn.on "click", @scroll_click

	scroll_check : (e) =>
		if jQuery(window).scrollTop() > @distance
			@btn.removeClass @btn_hidden_class
		else
			@btn.addClass @btn_hidden_class

	scroll_click : (e) =>
		@document.animate { scrollTop: 0 }, @speed

new ScrollToTop
