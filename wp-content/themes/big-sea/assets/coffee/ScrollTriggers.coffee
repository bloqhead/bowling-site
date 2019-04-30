#
# ScrollTrigger
#
# Adds a class to the body so that you can
# trigger things on scroll.
#
# Example: `html.scrolled #navigation`
#

class ScrollTrigger

	constructor: () ->
		@window = jQuery window
		@document = jQuery "html"
		@scrolled_class = "scrolled"
		@distance = 50

		@scroll_change()

		if typeof jQuery.throttle is 'function'
			@window.scroll( jQuery.throttle( 100, @scroll_change ) )
		else
			@window.scroll @scroll_change

	scroll_change : (e) =>
		@window_top = @window.scrollTop()
		if @window_top >= @distance
			@document.addClass @scrolled_class
		else
			@document.removeClass @scrolled_class

new ScrollTrigger
