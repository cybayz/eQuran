<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite53485bd266325a3c1a958f1ae24d807
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/www/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite53485bd266325a3c1a958f1ae24d807::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite53485bd266325a3c1a958f1ae24d807::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
