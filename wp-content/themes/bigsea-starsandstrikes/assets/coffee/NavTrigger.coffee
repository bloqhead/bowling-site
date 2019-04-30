# 
# Mobile Nav Trigger
# 

class NavTrigger

  constructor: () ->
    @hamburger = jQuery('.hamburger')
    @navContainer = jQuery('.top-bar')
    @activeClass = 'is-active'
    @parentClass = 'is-locked'

    @trigger @hamburger, @activeClass, @parentClass, 'body', @navContainer

  trigger: (el, active, locked, parent, nav) ->
    return if el.length is 0
    el.on 'click', (e) ->
      jQuery(@).toggleClass active
      jQuery(parent).toggleClass locked
      nav.toggleClass active

new NavTrigger