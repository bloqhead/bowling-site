<?php

namespace Coral\Locations\Elements;

class Templates
{
    const PATH = 'templates/';
    public static function find($template)
    {
        $defaultPath = self::getFullPath();
        $templatePath = get_template_directory();
        $stylesheetPath = get_stylesheet_directory();

        if (file_exists(trailingslashit($stylesheetPath) . $template . '.php')) {
            return trailingslashit($stylesheetPath) . $template . '.php';
        } elseif (file_exists(trailingslashit($templatePath) . $template . '.php')) {
            return trailingslashit($templatePath) . $template . '.php';
        } elseif (file_exists(trailingslashit($defaultPath) . $template . '.php')) {
            return trailingslashit($defaultPath) . $template . '.php';
        }

        throw new \Exception("The Template '$template' could not be found.");
    }

    protected static function getFullPath()
    {
        return apply_filters('coralLocations__template_path', CORAL_LOCATIONS_PATH . self::PATH);
    }
}