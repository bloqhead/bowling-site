#
# Affixed Location Selector
#

(($) ->

	mainClass = 'show-affixed-location-selector'
	contentBlock = $('.affixed-location-selector__content')
	expandTrigger = $('.affixed-location-selector__changer')
	$body = $('body')

	locationTooltip = $('.affixed-location-selector__tooltip')
	tooltipTrigger = $('.user-actions__mobile-selector, .user-actions__desktop-selector')

	# add a class once the page is loaded
	# $(window).on 'load', ->
	# 	$('html').addClass mainClass

	# adjust the top padding to accommodate for the bar as needed
	# $(window).on 'load resize', ->
	# 	i = $('.affixed-location-selector__initial').outerHeight() + 'px'
	# 	$('body').css 'padding-top': i

	# expand the location list on button click
	tooltipTrigger.on 'click', (e) ->
		$(@).toggleClass 'is-active'
		locationTooltip.toggleClass 'is-expanded'

		if not locationTooltip.hasClass 'update-attempted'
			window.getLocationsByGeolocation()
			locationTooltip.addClass 'update-attempted'

		e.preventDefault()

	$body.on 'coral_locations_geolocation_waiting', (e) =>
		locationTooltip.addClass 'is-updating'

	$body.on 'coral_locations_geolocation_complete', (e) =>
		locationTooltip.removeClass 'is-updating'
	
	$body.on 'coral_locations_geolocation_data', (e, data) =>
		locationTooltip.html data

) jQuery