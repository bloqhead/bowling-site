#
#
#   Filtering Class, originally built for Attractions
#
#

$ = jQuery

Filter = (element) ->
    @element = element
    @$element = $(element)
    @$triggers = $('body').find('[data-filter]')
    @$filterable = $('body').find('[data-filter-terms]')

    return @

Filter.prototype =
    init : () ->
        @$triggers.on 'click', (e) =>
            e.preventDefault()

            $target = $(e.target).parents('[data-filter]')
            @changeTarget $target
            @applyFilters $target.data('filter')
            
        return @

    changeTarget : (target) ->
        @$triggers.removeClass('active')
        target.addClass('active')
    
    applyFilters : (filter) ->
        # @$filterable.hide().each (item) ->
        #     $current = $ @
        #     filters = $current.data('filter-terms')
        #     $current.show() if $.inArray(filter, filters) >= 0

        # Stars & Strikes Specific, find all icons and make them shmexy
        @$filterable
            .find('i')
                .removeClass('active')
            .filter('.ss-icon-'+filter)
                .addClass('active')

        return true


jQuery.fn.coralFilter = () ->
    return @.each () ->
        new Filter(@).init()

window.Filter = Filter;