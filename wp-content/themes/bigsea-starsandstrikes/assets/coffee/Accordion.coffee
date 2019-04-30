#
# Accordion
# 
# Adapted from Eckerd project
#

class Accordion

  constructor: ->
    @header = ".accordion__header"
    @content = ".accordion__item"
    @allTrigger = ".accordion__all"
    @activeClass = "is-active"

    @allItemsOnPage = jQuery(@header).parent @content

    # run the single block toggler
    @registerIndividualToggle @header,  "click"

    # run the toggler that toggles ALL of the blocks
    @registerAllToggle @allTrigger,  "click"

  # this triggers blocks on a single item basis
  registerIndividualToggle : (objectToTrigger, triggerAction) =>
    jQuery(objectToTrigger).on triggerAction, (e) =>
      current = jQuery e.currentTarget
      e.preventDefault()
      current.parent(@content).toggleClass @activeClass
      @updateAllTriggerStatus()

  registerAllToggle : (objectToTrigger, triggerAction) =>
    jQuery(objectToTrigger).on triggerAction, (e) =>
      current = jQuery e.currentTarget
      e.preventDefault()
      current.toggleClass @activeClass

      @allItemsOnPage.removeClass @activeClass
      if current.hasClass @activeClass
        @allItemsOnPage.addClass @activeClass

  updateAllTriggerStatus : () =>
    allTriggerObject = jQuery @allTrigger
    total = @allItemsOnPage.length
    activeObjects = @allItemsOnPage.map (i, element) =>
      return element if jQuery(element).hasClass @activeClass
    activeCount = activeObjects.length

    allTriggerObject.removeClass @activeClass
    if total == activeCount
      allTriggerObject.addClass @activeClass

new Accordion
