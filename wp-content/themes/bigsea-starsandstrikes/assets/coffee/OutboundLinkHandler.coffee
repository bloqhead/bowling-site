#
# Open outbound links in a new window/tab automagically
#

(->
  jQuery('a:not(.ndpl-component__code-toggle):not(.ext-click-exclude)').filter (i, el) ->
    startOfUrl = location.protocol + '//' + location.hostname
    target = el.href.indexOf(startOfUrl) == 0
    if target == false
      jQuery(this).on 'click', (e) ->
        e.preventDefault()
        window.open jQuery(this).attr('href'), '_blank'
).call this
