<?php

namespace Core\Application;

class Session
{

    /**
     * Session instance
     * @var Session 
     */
    private static $_instance;

    /**
     * Session data
     * @var mixed 
     */
    private static $_vars;

    /**
     * get instance of Session
     * @return Session
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self;
        }
        self::$_instance->init();
        return self::$_instance;
    }

    /**
     * init data of Session instance by data from $_SESSION
     */
    public static function init()
    {
        foreach ($_SESSION as $key => $value) {
            self::$_vars[$key] = $value;
        }
    }

    /**
     * Get data from Session instance
     * @param integer|string $key
     * @return mixed
     */
    public static function get($key)
    {
        if (isset(self::$_vars[$key])) {
            return self::$_vars[$key];
        } else {
            return false;
        }
    }

    /**
     * Set data in Session instance
     * @param integer|string $key
     * @param mixed $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

}
