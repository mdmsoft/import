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
     *
     * Import::using([
     *     'yii\helpers\Html',
     *     'yii\bootstrap\Html' => 'BHtml'
     * ]);
     * ```
     * @param string $namespace
     * @throws BadMethodCallException
     */
    public static function using($namespace, $as = null)
    {
        if (!self::$_registered) {
            spl_autoload_register(['Import', 'load']);
            self::$_registered = true;
        }
        if (is_array($namespace)) {
            foreach ($namespace as $class => $alias) {
                if (is_int($class)) {
                    static::using($alias);
                } else {
                    static::using($class, $alias);
                }
            }
            return;
        }

        $namespace = trim($namespace, '\\');
        if (($pos = strrpos($namespace, '\\')) !== false) {
            $ns = trim(substr($namespace, 0, $pos), '\\');
            $alias = substr($namespace, $pos + 1);
        } else {
            $ns = '';
            $alias = $namespace;
        }

        if ($alias === '*') {
            self::$_paths[$ns] = true;
        } else {
            self::$_classMap[$as ? : $alias] = $namespace;
        }
    }

    /**
     * Autoload class
     * @param string $class
     * @return boolean
     */
    public static function load($class)
    {
        if (empty(self::$_paths) && empty(self::$_classMap)) {
            return;
        }
        if (($pos = strrpos($class, '\\')) !== false) {
            $alias = substr($class, $pos + 1);
        } else {
            $alias = $class;
        }
        if (isset(self::$_classMap[$alias])) {
            return class_alias(self::$_classMap[$alias], $class);
        } else {
            foreach (array_keys(self::$_paths) as $path) {
                if (class_exists(rtrim($path . '\\' . $alias, '\\'))) {
                    return class_alias(rtrim($path . '\\' . $alias, '\\'), $class);
                }
            }
        }
    }
}
