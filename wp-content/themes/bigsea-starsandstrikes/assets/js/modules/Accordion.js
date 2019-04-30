(function() {
    // Accordion

  // Adapted from Eckerd project

  var Accordion;

  Accordion = class Accordion {
    constructor() {
      // this triggers blocks on a single item basis
      this.registerIndividualToggle = this.registerIndividualToggle.bind(this);
      this.registerAllToggle = this.registerAllToggle.bind(this);
      this.updateAllTriggerStatus = this.updateAllTriggerStatus.bind(this);
      this.header = ".accordion__header";
      this.content = ".accordion__item";
      this.allTrigger = ".accordion__all";
      this.activeClass = "is-active";
      this.allItemsOnPage = jQuery(this.header).parent(this.content);
      // run the single block toggler
      this.registerIndividualToggle(this.header, "click");
      // run the toggler that toggles ALL of the blocks
      this.registerAllToggle(this.allTrigger, "click");
    }

    registerIndividualToggle(objectToTrigger, triggerAction) {
      return jQuery(objectToTrigger).on(triggerAction, (e) => {
        var current;
        current = jQuery(e.currentTarget);
        e.preventDefault();
        current.parent(this.content).toggleClass(this.activeClass);
        return this.updateAllTriggerStatus();
      });
    }

    registerAllToggle(objectToTrigger, triggerAction) {
      return jQuery(objectToTrigger).on(triggerAction, (e) => {
        var current;
        current = jQuery(e.currentTarget);
        e.preventDefault();
        current.toggleClass(this.activeClass);
        this.allItemsOnPage.removeClass(this.activeClass);
        if (current.hasClass(this.activeClass)) {
          return this.allItemsOnPage.addClass(this.activeClass);
        }
      });
    }

    updateAllTriggerStatus() {
      var activeCount, activeObjects, allTriggerObject, total;
      allTriggerObject = jQuery(this.allTrigger);
      total = this.allItemsOnPage.length;
      activeObjects = this.allItemsOnPage.map((i, element) => {
        if (jQuery(element).hasClass(this.activeClass)) {
          return element;
        }
      });
      activeCount = activeObjects.length;
      allTriggerObject.removeClass(this.activeClass);
      if (total === activeCount) {
        return allTriggerObject.addClass(this.activeClass);
      }
    }

  };

  new Accordion;

}).call(this);
