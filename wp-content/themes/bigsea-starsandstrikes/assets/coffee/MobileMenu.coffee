#
# Mobile menu controls
#

class MobileMenu

  constructor: ->
    # @targetMenu     = jQuery '.top-bar > .inner > .menu'
    @targetMenu     = jQuery '.top-bar > .inner > .menu-container > .menu'
    @icon           = '<i class="far fa-angle-down no-transform mobile-menu-item-icon"></i>'
    @activeClass    = 'is-active'
    @dropdownItem   = @targetMenu.find 'li.has-dropdown'
    @dropdownLink   = @dropdownItem.find '> a'

    # do nothing if there are no dropdowns present
    return if jQuery('li.has-dropdown').length is 0

    jQuery(window).on 'load', =>
      if window.innerWidth < 960
        @ParentLinkCreator()

    jQuery(window).on 'load resize', =>
      if 'ontouchstart' of document.documentElement
        @ToggleActiveClass @dropdownLink, @activeClass
      @SubmenuIndicator @dropdownLink, @icon
      @Cleanup()

  #
  # Toggle the active class of the parent menu item
  #
  ToggleActiveClass : (dropdown, activeClass) =>
    dropdown.on 'click', (e) ->
      jQuery(@).toggleClass activeClass
      e.preventDefault();

  #
  # Add the indicator icon that denotes a parent has submenu items
  #
  SubmenuIndicator : (link, icon) =>
    if link.find("i.mobile-menu-item-icon").length is 0
      @dropdownLink.append icon

  #
  # Append the parent link to the top of the submenu for mobile
  #
  ParentLinkCreator : =>
    jQuery('li.has-dropdown').each ->
      link = jQuery(@).find '> a'
      subMenu = jQuery(@).find '> a + .menu'
      href = link.attr 'href'
      text = link.text()
      # only append the link if it's not a placeholder...
      if href != "#"
        subMenu.prepend "<li class='menu-item'><a href='#{href}'>#{text}</a></li>"

  #
  # Clean up tasks for when an orientation change occurs
  # or a similar event
  #
  Cleanup : =>
    i = 0

    if i is 0 and window.innerWidth >= 960
      @dropdownLink.find("i.mobile-menu-item-icon").remove()
      i = 1

    if i is 1 and window.innerWidth < 960
      @SubmenuIndicator @dropdownLink, @icon
      i = 0

new MobileMenu
