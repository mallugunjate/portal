<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit276fa3f6fb6340e7591c8369c5c43238
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

        spl_autoload_register(array('ComposerAutoloaderInit276fa3f6fb6340e7591c8369c5c43238', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit276fa3f6fb6340e7591c8369c5c43238', 'loadClassLoader'));

        $map = require __DIR__ . '/autoload_namespaces.php';
        foreach ($map as $namespace => $path) {
            $loader->set($namespace, $path);
        }

        $map = require __DIR__ . '/autoload_psr4.php';
        foreach ($map as $namespace => $path) {
            $loader->setPsr4($namespace, $path);
        }

        $classMap = require __DIR__ . '/autoload_classmap.php';
        if ($classMap) {
            $loader->addClassMap($classMap);
        }

        $loader->register(true);

        $includeFiles = require __DIR__ . '/autoload_files.php';
        foreach ($includeFiles as $file) {
            composerRequire276fa3f6fb6340e7591c8369c5c43238($file);
        }

        return $loader;
    }
}

function composerRequire276fa3f6fb6340e7591c8369c5c43238($file)
{
    require $file;
}
