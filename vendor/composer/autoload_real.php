<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit10f32a1a5686a39700c5815d7236eb01
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit10f32a1a5686a39700c5815d7236eb01', 'loadClassLoader'), true, true);
        include_once 'vendor/composer/ClassLoader.php';
        self::$loader = $loader = new ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit10f32a1a5686a39700c5815d7236eb01', 'loadClassLoader'));

        $map = require dirname(__FILE__) . '/autoload_namespaces.php';
        foreach ($map as $namespace => $path) {
            $loader->set($namespace, $path);
        }

        $map = require dirname(__FILE__) . '/autoload_psr4.php';
        foreach ($map as $namespace => $path) {
            $loader->setPsr4($namespace, $path);
        }

        $classMap = require dirname(__FILE__) . '/autoload_classmap.php';
        if ($classMap) {
            $loader->addClassMap($classMap);
        }

        $loader->register(true);

        return $loader;
    }
}

function composerRequire10f32a1a5686a39700c5815d7236eb01($file)
{
    require $file;
}