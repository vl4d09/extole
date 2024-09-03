<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitddb20cc8a8633aa8b72462fffc4e4e93
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

        spl_autoload_register(array('ComposerAutoloaderInitddb20cc8a8633aa8b72462fffc4e4e93', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitddb20cc8a8633aa8b72462fffc4e4e93', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitddb20cc8a8633aa8b72462fffc4e4e93::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
