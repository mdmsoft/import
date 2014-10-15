<?php

/**
 * Import. Use to import all class under namespace
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Import
{
    private static $_paths = [];
    private static $_classMap = [];
    private static $_registered = false;

    /**
     * Import namespace
     * ```
     * Import::using('yii\bootstrap\*');
     * Import::using('yii\widgets\ActiveForm');
     * ```
     * @param string $namespace
     * @throws BadMethodCallException
     */
    public static function using($namespace)
    {
        if (!static::$_registered) {
            spl_autoload_register(['Import', 'load']);
            static::$_registered = true;
        }
        $namespace = trim($namespace, '\\');
        if (($pos = strrpos($namespace, '\\')) !== false) {
            $ns = trim(substr($namespace, 0, $pos), '\\');
            $alias = substr($namespace, $pos + 1);
            if ($alias === '*') {
                static::$_paths[] = $ns;
                static::$_paths = array_unique(static::$_paths);
            } else {
                static::$_classMap[$alias] = $namespace;
            }
        } else {
            throw new BadMethodCallException("Invalid import alias: $namespace");
        }
    }

    /**
     * Autoload class
     * @param string $class
     * @return boolean
     */
    public static function load($class)
    {
        if (empty(static::$_paths) && empty(static::$_classMap)) {
            return;
        }
        if (strpos($class, '\\') === false) {
            if (isset(static::$_classMap[$class])) {
                return class_alias(static::$_classMap[$class], $class);
            } else {
                foreach (static::$_paths as $path) {
                    if (class_exists($path . '\\' . $class)) {
                        return class_alias($path . '\\' . $class, $class);
                    }
                }
            }
        }
    }
}