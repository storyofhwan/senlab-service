<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit113e416f59139aad2a4aa803844d3c54
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'senMatchingRate\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'senMatchingRate\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit113e416f59139aad2a4aa803844d3c54::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit113e416f59139aad2a4aa803844d3c54::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
