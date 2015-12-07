<?php

namespace Application;

use Core\Application\Registry;
use Core\Application\Exception;

class BootStrap
{

    /**
     * call auto loader and set Registry with application config
     */
    public function run()
    {
        spl_autoload_register(array($this, 'load'));
        $settings = require 'config' . DS . 'application.php';
        Registry::set('settings', $settings);
    }

    /**
     * Class auto loader
     * @param string $class
     * @throws Exception
     */
    public function load($class)
    {
        $className = str_replace("\\", DS, $class);
        if (file_exists(ROOT_PATH . $className . '.php')) {
            require_once ROOT_PATH . $className . '.php';
        } elseif (file_exists(LIBRARY_PATH . DS . $className . '.php')) {
            require_once LIBRARY_PATH . DS . $className . '.php';
        } elseif (!strstr($className, 'Controller')) {
            throw new Exception("Class $className was not found");
        }
    }

}
