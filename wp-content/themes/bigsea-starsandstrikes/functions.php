<?php

date_default_timezone_set('America/New_York');

define('BIGSEA_THEME', get_template_directory());

/**
 * General Hooks
 */
require get_stylesheet_directory() . '/library/hooks.php';

/**
 * Widgets
 */
require get_stylesheet_directory() . '/library/widgets.php';

/**
 * Shortcodes
 */
require get_stylesheet_directory() . '/library/shortcodes.php';

/**
 * Custom post types
 */
require get_stylesheet_directory() . '/library/custom-post-types.php';

/**
 * Custom taxonomies
 */
require get_stylesheet_directory() . '/library/custom-taxonomies.php';

/**
 * Advanced Custom Fields
 */
require get_stylesheet_directory() . '/library/advanced-custom-fields.php';

/**
 * Template Tags
 */
require get_stylesheet_directory() . '/library/template-tags.php';

/**
 * Gravity Forms
 */
require get_stylesheet_directory() . '/library/gravity-forms.php';

/**
 * Triple Seat
 */
require get_stylesheet_directory() . '/library/triple-seat.php';

/**
 * Coral Locations
 */
require get_stylesheet_directory() . '/library/coral-locations.php';