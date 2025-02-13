<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit34e143e4c08e34f0989981522606f7f0
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Exads\\' => 6,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Exads\\' => 
        array (
            0 => __DIR__ . '/..' . '/exads/ab-test-data/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit34e143e4c08e34f0989981522606f7f0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit34e143e4c08e34f0989981522606f7f0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit34e143e4c08e34f0989981522606f7f0::$classMap;

        }, null, ClassLoader::class);
    }
}
