(($) ->
    jQuery('.notice').on 'click', (e) ->
        e.preventDefault();
        jQuery(@).parent().parent().find('.hours__tooltip').fadeToggle()

    jQuery('.hours__tooltip-close').on 'click', (e) ->
        e.preventDefault();
        jQuery(@).parent().fadeOut()
) jQuery