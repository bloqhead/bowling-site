(function() {
    //   Filtering Class, originally built for Attractions

  var $, Filter;

  $ = jQuery;

  Filter = function(element) {
    this.element = element;
    this.$element = $(element);
    this.$triggers = $('body').find('[data-filter]');
    this.$filterable = $('body').find('[data-filter-terms]');
    return this;
  };

  Filter.prototype = {
    init: function() {
      this.$triggers.on('click', (e) => {
        var $target;
        e.preventDefault();
        $target = $(e.target).parents('[data-filter]');
        this.changeTarget($target);
        return this.applyFilters($target.data('filter'));
      });
      return this;
    },
    changeTarget: function(target) {
      this.$triggers.removeClass('active');
      return target.addClass('active');
    },
    applyFilters: function(filter) {
      // @$filterable.hide().each (item) ->
      //     $current = $ @
      //     filters = $current.data('filter-terms')
      //     $current.show() if $.inArray(filter, filters) >= 0

      // Stars & Strikes Specific, find all icons and make them shmexy
      this.$filterable.find('i').removeClass('active').filter('.ss-icon-' + filter).addClass('active');
      return true;
    }
  };

  jQuery.fn.coralFilter = function() {
    return this.each(function() {
      return new Filter(this).init();
    });
  };

  window.Filter = Filter;

}).call(this);
