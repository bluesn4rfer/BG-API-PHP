<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc3f8b5103e47a4bca5afeb46197efc93
{
    public static $files = array (
        'cfb7c780793bfa1138356bbe97dc66da' => __DIR__ . '/..' . '/leafs/http/src/functions.php',
        'e408a977efcff868a334a05904a33d25' => __DIR__ . '/..' . '/leafs/session/src/functions.php',
        'f7a40c1f1f5eb11aee5f7554cb0c8ea7' => __DIR__ . '/..' . '/leafs/form/src/functions.php',
        '88eacf4349b66d3ee2fc2749fea922ce' => __DIR__ . '/..' . '/leafs/db/src/functions.php',
        'cd18aec96aea037961c7c777fe0159ab' => __DIR__ . '/..' . '/leafs/leaf/src/functions.php',
        '398537c6a5171484a0c866c3193cd09c' => __DIR__ . '/..' . '/leafs/auth/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'L' => 
        array (
            'Leaf\\Http\\' => 10,
            'Leaf\\Helpers\\' => 13,
            'Leaf\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Leaf\\Http\\' => 
        array (
            0 => __DIR__ . '/..' . '/leafs/http/src',
        ),
        'Leaf\\Helpers\\' => 
        array (
            0 => __DIR__ . '/..' . '/leafs/password/src',
        ),
        'Leaf\\' => 
        array (
            0 => __DIR__ . '/..' . '/leafs/anchor/src',
            1 => __DIR__ . '/..' . '/leafs/exception/src',
            2 => __DIR__ . '/..' . '/leafs/leaf/src',
            3 => __DIR__ . '/..' . '/leafs/router/src',
            4 => __DIR__ . '/..' . '/leafs/session/src',
            5 => __DIR__ . '/..' . '/leafs/form/src',
            6 => __DIR__ . '/..' . '/leafs/db/src',
            7 => __DIR__ . '/..' . '/leafs/date/src',
            8 => __DIR__ . '/..' . '/leafs/auth/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc3f8b5103e47a4bca5afeb46197efc93::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc3f8b5103e47a4bca5afeb46197efc93::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc3f8b5103e47a4bca5afeb46197efc93::$classMap;

        }, null, ClassLoader::class);
    }
}
