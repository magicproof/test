<?php

namespace Core\Application;

class Registry
{

    /**
     * Hash table
     * @var array
     */
    private static $_registry = array();

    /**
     * Set some data by key into registry instance
     * @param integer|string $key
     * @param mixed $object
     */
    public static function set($key, $object)
    {
        if (!isset(self::$_registry[$key])) {
            self::$_registry[$key] = $object;
        }
    }

    /**
     * Get an object by key from registry
     * @param integer|string $key
     * @return mixed
     */
    public static function get($key)
    {
        return self::$_registry[$key];
    }

}
