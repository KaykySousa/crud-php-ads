<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitd7cf3f5e38ff935bbe926c90240b088d
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitd7cf3f5e38ff935bbe926c90240b088d', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitd7cf3f5e38ff935bbe926c90240b088d', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitd7cf3f5e38ff935bbe926c90240b088d::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
