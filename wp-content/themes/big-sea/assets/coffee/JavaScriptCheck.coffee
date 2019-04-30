#
# Add a class when JS is enabled
#
# Removes the `no-js` class from the
# `html` element when JS is enabled,
# and adds a `yes-js` class.
# This allows you to target things
# only when JS is present.
#

jQuery("html").removeClass("no-js").addClass("yes-js")
