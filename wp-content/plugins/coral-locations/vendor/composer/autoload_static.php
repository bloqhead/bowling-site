<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit69ba230815a3ce6f2324156839e74cf1
{
    public static $files = array (
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        'ddc0a4d7e61c0286f0f8593b1903e894' => __DIR__ . '/..' . '/clue/stream-filter/src/functions.php',
        '8cff32064859f4559445b89279f3199c' => __DIR__ . '/..' . '/php-http/message/src/filters.php',
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..' . '/guzzlehttp/promises/src/functions_include.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\SimpleCache\\' => 16,
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Message\\' => 17,
        ),
        'H' => 
        array (
            'Http\\Promise\\' => 13,
            'Http\\Message\\' => 13,
            'Http\\Discovery\\' => 15,
            'Http\\Client\\' => 12,
            'Http\\Adapter\\Guzzle6\\' => 21,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
            'Geocoder\\Provider\\Yandex\\' => 25,
            'Geocoder\\Provider\\GoogleMaps\\' => 29,
            'Geocoder\\Provider\\FreeGeoIp\\' => 28,
            'Geocoder\\Plugin\\' => 16,
            'Geocoder\\Http\\' => 14,
            'Geocoder\\' => 9,
        ),
        'C' => 
        array (
            'Coral\\Locations\\' => 16,
            'Clue\\StreamFilter\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\SimpleCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/simple-cache/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Http\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-http/promise/src',
        ),
        'Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-http/message/src',
            1 => __DIR__ . '/..' . '/php-http/message-factory/src',
        ),
        'Http\\Discovery\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-http/discovery/src',
        ),
        'Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-http/httplug/src',
        ),
        'Http\\Adapter\\Guzzle6\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-http/guzzle6-adapter/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'Geocoder\\Provider\\Yandex\\' => 
        array (
            0 => __DIR__ . '/..' . '/geocoder-php/yandex-provider',
        ),
        'Geocoder\\Provider\\GoogleMaps\\' => 
        array (
            0 => __DIR__ . '/..' . '/geocoder-php/google-maps-provider',
        ),
        'Geocoder\\Provider\\FreeGeoIp\\' => 
        array (
            0 => __DIR__ . '/..' . '/geocoder-php/free-geoip-provider',
        ),
        'Geocoder\\Plugin\\' => 
        array (
            0 => __DIR__ . '/..' . '/geocoder-php/plugin',
        ),
        'Geocoder\\Http\\' => 
        array (
            0 => __DIR__ . '/..' . '/geocoder-php/common-http',
        ),
        'Geocoder\\' => 
        array (
            0 => __DIR__ . '/..' . '/willdurand/geocoder',
        ),
        'Coral\\Locations\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Clue\\StreamFilter\\' => 
        array (
            0 => __DIR__ . '/..' . '/clue/stream-filter/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit69ba230815a3ce6f2324156839e74cf1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit69ba230815a3ce6f2324156839e74cf1::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
