<?php
/**
 * Big Sea functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Big_Sea
 */

/**
 * Timber plugin check
 *
 * Checkes to ensure the Timber plugin is installed and active.
 * If it isn't, a placeholder fallback page is displayed and
 * a notice is thrown on WP admin.
 */
require get_template_directory() . '/library/timber-check.php';

/**
 * Timber additions
 *
 * If you want to add things to Timber's context or do
 * any other Timber additions and extensions, they go here.
 */
if ( class_exists( 'Timber' ) ) {
	require get_template_directory() . '/library/timber.php';
}

/**
 * Big Sea theme setup
 *
 * This is where all of the head cleanup is handled, as well
 * as styles and scripts, image sizes, widget areas, etc.
 */
require get_template_directory() . '/library/bigsea.php';

/**
 * Custom template tags
 */
require get_template_directory() . '/library/template-tags.php';

/**
 * Custom functions
 */
require get_template_directory() . '/library/bigsea-extras.php';
