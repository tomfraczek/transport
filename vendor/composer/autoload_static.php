<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticIniteedc7a442fa74200db0713d4f03106cb
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticIniteedc7a442fa74200db0713d4f03106cb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticIniteedc7a442fa74200db0713d4f03106cb::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
