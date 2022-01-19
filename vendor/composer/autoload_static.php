<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit982aaee960fbf9f9f57522ccfe3bb173
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PacientesSys\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PacientesSys\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit982aaee960fbf9f9f57522ccfe3bb173::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit982aaee960fbf9f9f57522ccfe3bb173::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit982aaee960fbf9f9f57522ccfe3bb173::$classMap;

        }, null, ClassLoader::class);
    }
}